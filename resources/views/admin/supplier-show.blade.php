<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Profile - GoldenFields Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #047857 0%, #065f46 100%);
        }
        .btn-approve {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
        }
        .btn-suspend {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        }
        .btn-deactivate {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }
        .btn-role {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }
        .btn-chat {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
        }
    </style>
</head>
<body>
    <div class="min-h-screen bg-gray-50">
        <!-- Main Content -->
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header Section -->
            <div class="gradient-bg rounded-xl shadow-lg p-6 mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-white">Supplier Profile</h1>
                        <p class="text-green-100 mt-1">{{ $user->name }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $supplier->is_approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                       @switch($supplier->status)
                    @case('active')
                        ✅ Active
                        @break
                    @case('pending')
                        ⏳ Pending Approval
                        @break
                    @case('suspended')
                        ❌ Suspended
                        @break
                    @case('deactivated')
                        🚫 Deactivated
                        @break
                    @default
                        ⚠ Unknown Status
                @endswitch
                    </span>
                </div>
            </div>

            <!-- Information Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Basic Info Card -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-green-100">
                    <div class="bg-green-50 px-6 py-4 border-b border-green-100">
                        <h2 class="text-lg font-semibold text-gray-800">Business Information</h2>
                    </div>
                   <div class="bg-white rounded-xl shadow-md overflow-hidden border border-green-100">
    <div class="bg-green-50 px-6 py-4 border-b border-green-100">
        <h2 class="text-lg font-semibold text-green-800 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Supplier Details
        </h2>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Column 1 -->
            <div class="space-y-5">
                <!-- Email -->
                <div class="bg-gradient-to-br from-green-50 to-green-50/30 p-4 rounded-lg border border-green-100 hover:shadow-sm transition-shadow duration-200">
                        <p class="text-xs font-medium text-green-700 uppercase tracking-wider mb-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Email Address
                        </p>
                        <p class="text-gray-900 font-medium pl-5">
                            {{ $user->email }}
                        </p>
                </div>

                <!-- Phone -->
                <div class="bg-gradient-to-br from-green-50 to-green-50/30 p-4 rounded-lg border border-green-100 hover:shadow-sm transition-shadow duration-200">
                        <p class="text-xs font-medium text-green-700 uppercase tracking-wider mb-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Phone Number
                        </p>
                        <p class="text-gray-900 font-medium pl-5">
                            {{ $supplier->telNo ?? 'Not provided' }}
                        </p>
               </div>

                <!-- Registration Date -->
                <div class="bg-gradient-to-br from-green-50 to-green-50/30 p-4 rounded-lg border border-green-100 hover:shadow-sm transition-shadow duration-200">
                        <p class="text-xs font-medium text-green-700 uppercase tracking-wider mb-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Registration Date
                        </p>
                        <p class="text-gray-900 font-medium pl-5">
                             {{ $user->created_at ? $user->created_at->format('M d, Y') : 'Not Available' }}
                        </p>
                </div>

                <!-- Business Name -->
                 <div class="bg-gradient-to-br from-green-50 to-green-50/30 p-4 rounded-lg border border-green-100 hover:shadow-sm transition-shadow duration-200">
                        <p class="text-xs font-medium text-green-700 uppercase tracking-wider mb-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Business Name
                        </p>
                        <p class="text-gray-900 font-medium pl-5">
                            {{ $supplier->business_name ?? 'Not provided' }}
                        </p>
                </div>
            </div>

            <!-- Column 2 -->
            <div class="space-y-5">
                <!-- Business Type -->
                <div class="bg-gradient-to-br from-green-50 to-green-50/30 p-4 rounded-lg border border-green-100 hover:shadow-sm transition-shadow duration-200">
                        <p class="text-xs font-medium text-green-700 uppercase tracking-wider mb-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Business Type
                        </p>
                        <p class="text-gray-900 font-medium pl-5">
                            {{ $supplier->business_type ?? 'Not provided' }}
                        </p>
                </div>

                <!-- Location -->
                <div class="bg-gradient-to-br from-green-50 to-green-50/30 p-4 rounded-lg border border-green-100 hover:shadow-sm transition-shadow duration-200">
                        <p class="text-xs font-medium text-green-700 uppercase tracking-wider mb-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Location
                        </p>
                        <p class="text-gray-900 font-medium pl-5">
                            {{ $supplier->location ?? 'Not provided' }}
                        </p>
                </div>

                <!-- TIN -->
                <div class="bg-gradient-to-br from-green-50 to-green-50/30 p-4 rounded-lg border border-green-100 hover:shadow-sm transition-shadow duration-200">
                        <p class="text-xs font-medium text-green-700 uppercase tracking-wider mb-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Tax Identification Number
                        </p>
                        <p class="text-gray-900 font-medium pl-5">
                            {{ $supplier->TIN ?? 'Not provided' }}
                        </p>
                </div>

                <!-- Tax ID -->
                <div class="bg-green-50/50 p-4 rounded-lg border border-green-100">
                    <p class="text-xs font-medium text-green-700 uppercase tracking-wider mb-1">Tax ID</p>
                    <p class="text-gray-900 font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        {{ $supplier->Tax_ID ?? 'Not provided' }}
                    </p>
                </div>

                <!-- Account Status -->
                <div class="bg-green-50/50 p-4 rounded-lg border border-green-100">
                    <p class="text-xs font-medium text-green-700 uppercase tracking-wider mb-1">Account Status</p>
                    <p class="text-gray-900 font-medium flex items-center">
                        @switch($supplier->status)
                            @case('active')
                                <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                Active
                                @break
                            @case('pending')
                                <span class="w-2 h-2 rounded-full bg-yellow-500 mr-2"></span>
                                Pending Approval
                                @break
                            @case('suspended')
                                <span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span>
                                Suspended
                                @break
                            @case('deactivated')
                                <span class="w-2 h-2 rounded-full bg-gray-500 mr-2"></span>
                                Deactivated
                                @break
                            @default
                                <span class="w-2 h-2 rounded-full bg-gray-400 mr-2"></span>
                                Unknown Status
                        @endswitch
                    </p>
                </div>

               
            </div>
        
        </div>

         <!--business certificate-->
                <div class="flex items-center justify-between bg-green-50 rounded-lg p-4 mt-4">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-600 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900">Business Certificate</p>
                                    <p class="text-sm text-gray-500">PDF Document</p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $supplier->document_path) }}" target="_blank" class="bg-white border border-green-300 text-green-700 hover:bg-green-50 px-4 py-2 rounded-lg text-sm font-medium flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
                            </a>
                        </div>
    </div>
</div>

                </div>

                <!-- Documents Card -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-green-100">
                    <div class="bg-green-50 px-6 py-4 border-b border-green-100">
                        <h2 class="text-lg font-semibold text-gray-800">Vendor-Validation Submission</h2>
                    </div>
                    <div class="p-6 max-w-3xl mx-auto">
    @if (isset($vendorValidation) && $vendorValidation)
        <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 mb-8 border border-gray-100">
            

            <div class="space-y-4">
                <div class="grid grid-cols-1 gap-4">
                    <div class="bg-gradient-to-br from-green-50 to-green-50/30 border border-green-100 rounded-lg p-4">
                        <h3 class="text-sm font-medium text-green-800 mb-2">Business Registration</h3>
                        <p class="text-lg font-semibold text-gray-800">{{ $vendorValidation->brn }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gradient-to-br from-green-50 to-green-50/30 border border-green-100  rounded-lg p-4">
                            <h3 class="text-sm font-medium text-green-800 mb-2">Annual Revenue</h3>
                            <p class="text-lg font-semibold text-gray-800">{{ $vendorValidation->annual_revenue }} UGX</p>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-green-50/30 border border-green-100  rounded-lg p-4">
                            <h3 class="text-sm font-medium text-green-800 mb-2">Net Profit Margin</h3>
                            <p class="text-lg font-semibold text-gray-800">{{ $vendorValidation->net_profit_margin }}%</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gradient-to-br from-green-50 to-green-50/30 border border-green-100  rounded-lg p-4">
                            <h3 class="text-sm font-medium text-green-800 mb-2">Years of Operation</h3>
                            <p class="text-lg font-semibold text-gray-800">{{ $vendorValidation->years_of_operation }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-green-50/30 border border-green-100  rounded-lg p-4">
                            <h3 class="text-sm font-medium text-green-800 mb-2">Customer Rating</h3>
                            <p class="text-lg font-semibold text-gray-800">{{ $vendorValidation->customer_rating }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gradient-to-br from-green-50 to-green-50/30 border border-green-100  rounded-lg p-4">
                            <h3 class="text-sm font-medium text-green-800 mb-2">Tax Clearance</h3>
                            <p class="text-lg font-semibold text-gray-800">{{ $vendorValidation->tax_clearance }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-green-50/30 border border-green-100  rounded-lg p-4">
                            <h3 class="text-sm font-medium text-green-800 mb-2">Background Check</h3>
                            <p class="text-lg font-semibold text-gray-800">{{ $vendorValidation->background_check }}</p>
                        </div>
                    </div>
                </div>

                @if($vendorValidation->pdf_path)
                    <div class="mt-6">
                        <a href="{{ asset('storage/' . $vendorValidation->pdf_path) }}" target="_blank"
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            Download Submitted PDF
                        </a>
                    </div>
                @endif
            </div>
        </div>

        @php
            $response = null;
            if ($validation && $validation->validation_result) {
                $raw = $validation->validation_result;
                $jsonString = preg_replace('/^(Success|Failed):\s*/', '', $raw);
                $response = json_decode($jsonString, true);
            }
        @endphp

        @if ($response)
            <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 border @if($response['success']) border-green-100 @else border-red-100 @endif">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        @if ($response['success'])
                            <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        @else
                            <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium @if($response['success']) text-green-800 @else text-red-800 @endif">
                            @if($response['success']) Validation Passed @else Validation Failed @endif
                        </h3>
                        <div class="mt-2 space-y-3">
                            <div>
                                <p class="text-sm text-gray-600"><strong>Message:</strong> {{ $response['message'] ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">
                                    <strong>Status:</strong>
                                    @if ($response['success'])
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Success</span>
                                    @else
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Failed</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                @if ($response && !$response['success'])
                                    <p class="text-sm font-medium text-gray-600 mb-1">Reasons for failure:</p>
                                    <ul class="text-sm text-red-600 list-disc list-inside space-y-1">
                                        @foreach ($response['failedCriteria'] as $reason)
                                            <li>{{ $reason }}</li>
                                        @endforeach
                                    </ul>
                                @elseif ($response && $response['success'])
                                    <p class="text-sm text-gray-600">
                                        <strong>Visit scheduled for:</strong>
                                        <span class="text-green-700 ml-1">
                                            {{ $validation->visit_date ? \Carbon\Carbon::parse($validation->visit_date)->format('F j, Y') : 'Pending' }}
                                        </span>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="bg-white rounded-xl shadow-sm p-6 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">No validation submitted</h3>
            <p class="mt-1 text-sm text-gray-500">The supplier hasn't submitted any validation information yet.</p>
        </div>
    @endif
</div>
            </div>
        </div>

           




            <!-- Action Buttons -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-green-100 p-6 mb-8">
                <h2 class="text-lg font-semibold text-green-800 mb-4">Supplier Actions</h2>
                <div class="flex flex-wrap gap-4">
                    <!-- Approve Button -->
                    <form action="{{ route('admin.suppliers.activate', $user->id) }}" method="POST">
                       @csrf
                       @method('PATCH')
                       <button class="bg-green-600 text-white px-6 py-3 rounded-lg shadow-sm font-medium flex items-center transition-all duration-200 hover:shadow-md hover:scale-[1.02]">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                          </svg>
                          Activate Supplier
                       </button>
                    </form>


                    <!-- Suspend Button -->
                    <form method="POST" action="{{ route('admin.suppliers.suspend', $supplier->user_id) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn-suspend text-white px-6 py-3 rounded-lg shadow-sm font-medium flex items-center transition-all duration-200 hover:shadow-md hover:scale-[1.02]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Suspend Account
                        </button>
                    </form>

                    <!-- Deactivate Button -->
                    <form method="POST" action="{{ route('admin.suppliers.deactivate', $supplier->user_id) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn-deactivate text-white px-6 py-3 rounded-lg shadow-sm font-medium flex items-center transition-all duration-200 hover:shadow-md hover:scale-[1.02]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                            Deactivate
                        </button>
                    </form>

                    <!-- Change Role Button -->
                    <a href="#" class="btn-role text-white px-6 py-3 rounded-lg shadow-sm font-medium flex items-center transition-all duration-200 hover:shadow-md hover:scale-[1.02]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Change Role
                    </a>

                    <!-- Chat Button -->
                    <a href="{{ route('admin.chat.supplier', $user->id) }}" class="btn-chat text-white px-6 py-3 rounded-lg shadow-sm font-medium flex items-center transition-all duration-200 hover:shadow-md hover:scale-[1.02]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Open Chat
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>