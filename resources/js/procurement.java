// Update datetime display
function updateDateTime() {
    const now = new Date();
    const options = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    document.getElementById('datetime').textContent = now.toLocaleDateString('en-US', options);
}

// Initialize charts
function initCharts() {
    // Monthly Requests Bar Chart
    const barCtx = document.getElementById('requestsChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Procurement Requests',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgba(255, 215, 0, 0.7)',
                borderColor: 'rgba(255, 215, 0, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#333'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(46, 139, 87, 0.1)'
                    },
                    ticks: {
                        color: '#333'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(46, 139, 87, 0.1)'
                    },
                    ticks: {
                        color: '#333'
                    }
                }
            }
        }
    });

    // Supplier Distribution Pie Chart
    const pieCtx = document.getElementById('suppliersChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Local', 'National', 'International'],
            datasets: [{
                data: [30, 40, 30],
                backgroundColor: [
                    'rgba(255, 215, 0, 0.7)',
                    'rgba(46, 139, 87, 0.7)',
                    'rgba(0, 100, 0, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 215, 0, 1)',
                    'rgba(46, 139, 87, 1)',
                    'rgba(0, 100, 0, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        color: '#333'
                    }
                }
            }
        }
    });
}

// Fetch updated metrics from server
async function fetchMetrics() {
    try {
        const response = await fetch('/procurement/metrics');
        if (!response.ok) throw new Error('Network response was not ok');
        
        const data = await response.json();
        
        // Update the metrics on the page
        document.querySelectorAll('.big-number')[0].textContent = data.requests;
        document.querySelectorAll('.big-number')[1].textContent = data.orders;
        document.querySelectorAll('.big-number')[2].textContent = data.received;
        document.querySelectorAll('.big-number')[3].textContent = data.suppliers;
    } catch (error) {
        console.error('Error fetching metrics:', error);
    }
}

// Initialize the dashboard
document.addEventListener('DOMContentLoaded', function() {
    updateDateTime();
    initCharts();
    
    // Update datetime every minute
    setInterval(updateDateTime, 60000);
    
    // Update metrics every 30 seconds
    fetchMetrics();
    setInterval(fetchMetrics, 30000);
    
    // Add event listeners for quick action buttons
    document.querySelectorAll('.action-btn').forEach(button => {
        button.addEventListener('click', function() {
            // In a real app, this would trigger the appropriate action
            alert(`Action: ${this.textContent.trim()}`);
        });
    });
    
    // Add event listeners for table actions
    document.querySelectorAll('.table-action').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const requestId = row.cells[0].textContent;
            alert(`Viewing details for request: ${requestId}`);
        });
    });
});