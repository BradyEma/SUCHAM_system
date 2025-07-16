<section class="metrics-section">
    <h2 class="section-title">Key Metrics</h2>
    <div class="metrics-container">
        <div class="metric-card">
            <i class="fas fa-clipboard-list gold-icon"></i>
            <h3>Procurement Requests</h3>
            <p class="big-number">{{ $requests }}</p>
            <p class="metric-change"><i class="fas fa-arrow-up"></i> 12% from last month</p>
        </div>
        
        <div class="metric-card">
            <i class="fas fa-file-contract gold-icon"></i>
            <h3>Purchase Orders</h3>
            <p class="big-number">{{ $orders }}</p>
            <p class="metric-change"><i class="fas fa-arrow-up"></i> 8% from last month</p>
        </div>
        
        <div class="metric-card">
            <i class="fas fa-truck-loading gold-icon"></i>
            <h3>Goods Received</h3>
            <p class="big-number">{{ $received }}</p>
            <p class="metric-change"><i class="fas fa-arrow-down"></i> 5% from last month</p>
        </div>
        
        <div class="metric-card">
            <i class="fas fa-people-carry gold-icon"></i>
            <h3>Suppliers</h3>
            <p class="big-number">{{ $suppliers }}</p>
            <p class="metric-change"><i class="fas fa-arrow-up"></i> 3 new this month</p>
        </div>
    </div>
</section>