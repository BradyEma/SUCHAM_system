package com.sucham.vendor_validator.controller;

import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Scanner;

import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.text.PDFTextStripper;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.multipart.MultipartFile;

@RestController
@RequestMapping("/api/vendors")
public class PdfUploadController {

    private static final String UPLOAD_DIR = "C:/sucham_uploads/";

    @PostMapping("/upload")
    public ResponseEntity<Object> uploadPdf(@RequestParam("file") MultipartFile file) {
        if (file.isEmpty() || !file.getOriginalFilename().endsWith(".pdf")) {
            return ResponseEntity.badRequest().body(Map.of(
                "success", false,
                "message", "Invalid file. Please upload a PDF."
            ));
        }

        try {
            File dir = new File(UPLOAD_DIR);
            if (!dir.exists()) dir.mkdirs();

            String filePath = UPLOAD_DIR + file.getOriginalFilename();
            File savedFile = new File(filePath);
            file.transferTo(savedFile);

            PDDocument document = PDDocument.load(savedFile);
            PDFTextStripper stripper = new PDFTextStripper();
            String text = stripper.getText(document);
            document.close();

            Map<String, String> data = parseTextNormalized(text);

            System.out.println("Parsed PDF data:");
            data.forEach((k, v) -> System.out.println(k + " = " + v));

            List<String> validationErrors = validateVendorDataMultipleFailures(data);

            if (validationErrors.isEmpty()) {
                return ResponseEntity.ok(Map.of(
                    "success", true,
                    "message", "PDF valid. Facility visit scheduled."
                ));
            } else {
                return ResponseEntity.status(HttpStatus.BAD_REQUEST).body(Map.of(
                    "success", false,
                    "message", "Validation failed",
                    "failedCriteria", validationErrors
                ));
            }

        } catch (IOException e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR)
                    .body(Map.of(
                        "success", false,
                        "message", "Failed to upload/validate PDF: " + e.getMessage()
                    ));
        }
    }

    // Parses lines into a Map with lowercase keys for normalization
    private Map<String, String> parseTextNormalized(String text) {
        Map<String, String> data = new HashMap<>();
        Scanner scanner = new Scanner(text);
        while (scanner.hasNextLine()) {
            String line = scanner.nextLine();
            if (line.contains(":")) {
                String[] parts = line.split(":", 2);
                String key = parts[0].trim().toLowerCase();
                String value = parts[1].trim();
                data.put(key, value);
            }
        }
        scanner.close();
        return data;
    }

    // Validate and collect all failures (returns empty list if valid)
    private List<String> validateVendorDataMultipleFailures(Map<String, String> data) {
        List<String> errors = new ArrayList<>();

        // Required keys check
        String[] requiredKeys = {
            "annual revenue", "net profit margin", "years of operation",
            "customer rating", "background check", "brn", "tax clearance"
        };
        for (String key : requiredKeys) {
            if (!data.containsKey(key)) {
                errors.add("Required criteria missing: " + key);
            }
        }

        if (!errors.isEmpty()) return errors;

        try {
            long revenue = Long.parseLong(data.getOrDefault("annual revenue", "0"));
            if (revenue < 10_000_000) errors.add("Annual revenue below required threshold (10M UGX).");

            double profitMargin = Double.parseDouble(data.getOrDefault("net profit margin", "0").replace("%", ""));
            if (profitMargin < 5.0) errors.add("Profit margin must be at least 5%.");

            int years = Integer.parseInt(data.getOrDefault("years of operation", "0"));
            if (years < 2) errors.add("At least 2 years of operation required.");

            double rating = Double.parseDouble(data.getOrDefault("customer rating", "0"));
            if (rating < 3.5) errors.add("Customer rating must be at least 3.5.");

            if (!"clear".equalsIgnoreCase(data.getOrDefault("background check", "")))
                errors.add("Background check must be 'Clear'.");

            String brn = data.getOrDefault("brn", "");
            if (!brn.matches("^BRN-\\d{4}$"))
                errors.add("BRN format invalid. Expected format: BRN-XXXX.");

            String tax = data.getOrDefault("tax clearance", "No");
            if (!tax.equalsIgnoreCase("yes"))
                errors.add("Missing tax clearance certificate.");

        } catch (Exception e) {
            errors.add("Error parsing or validating PDF data: " + e.getMessage());
        }

        return errors;
    }
}
