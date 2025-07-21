<div class="gf-container" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <div class="gf-header" style="border-bottom: 2px solid #FFD700; padding-bottom: 15px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
        <h2 style="color: #14532d; display: inline-block;">Procurement Requests</h2>
        <div>
            <button class="gf-btn-secondary" style="background-color: #14532d; color: white; border: none; padding: 8px 15px; border-radius: 4px; margin-right: 10px;">
                <i class="fas fa-filter"></i> Advanced Filters
            </button>
            <a href="{{ route('procurement-requests.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mb-4 inline-block">
                <button class="gf-btn-primary" style="background-color: #FFD700; color: #14532d; border: none; padding: 8px 15px; border-radius: 4px; font-weight: bold;">
                    + New Request
                </button>
            </a>
        </div>
    </div>
    
    <div class="gf-quick-filters" style="background-color: #F8F8F8; padding: 12px; border-radius: 6px; margin-bottom: 20px; display: flex; gap: 10px;">
        <button style="background-color: #FFFFFF; border: 1px solid #DDD; padding: 6px 12px; border-radius: 15px; font-size: 13px;">All</button>
        <button style="background-color: #FFEEAA; border: 1px solid #FFD700; padding: 6px 12px; border-radius: 15px; font-size: 13px;">Pending</button>
        <button style="background-color: #90EE90; border: 1px solid #14532d; padding: 6px 12px; border-radius: 15px; font-size: 13px;">Approved</button>
        <button style="background-color: #FFCCCB; border: 1px solid #FF6B6B; padding: 6px 12px; border-radius: 15px; font-size: 13px;">Rejected</button>
        <button style="background-color: #D3E0EA; border: 1px solid #7A9CC6; padding: 6px 12px; border-radius: 15px; font-size: 13px;">My Requests</button>
    </div>

    <table class="gf-data-table" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #14532d; color: white;">
            <tr>
                <th style="padding: 12px; text-align: left;">Request #</th>
                <th style="padding: 12px; text-align: left;">Request Date</th>
                <th style="padding: 12px; text-align: left;">Department</th>
                <th style="padding: 12px; text-align: left;">Priority</th>
                <th style="padding: 12px; text-align: left;">Status</th>
                <th style="padding: 12px; text-align: left;">Estimated Cost</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
                <tr style="border-bottom: 1px solid #EEE;">
                    <td style="padding: 12px; color: #14532d; font-weight: bold;">PR-{{ $request->id }}</td>
                    <td style="padding: 12px;">{{ \Carbon\Carbon::parse($request->created_at)->format('d M Y') }}</td>
                    <td style="padding: 12px;">{{ $request->requester ?? '—' }}</td>
                    <td style="padding: 12px;">{{ $request->department ?? '—' }}</td>
                    <td style="padding: 12px;">
                        <span style="background-color: #FFD700; color: #8B4513; padding: 3px 8px; border-radius: 12px; font-size: 12px;">
                            {{ ucfirst($request->priority ?? 'normal') }}
                        </span>
                    </td>
                    <td style="padding: 12px;">
                        <span class="gf-badge gf-badge-pending" style="background-color: #FFEEAA; color: #8B8000; padding: 4px 8px; border-radius: 12px; font-size: 12px;">
                            {{ ucfirst($request->status) }}
                        </span>
                    </td>
                    <td style="padding: 12px; font-weight: bold;">
                        UGX {{ number_format($request->estimated_cost ?? 0, 2) }}
                    </td>
                    <td style="padding: 12px;">
                        <a href="{{ route('procurement-requests.show', $request->id) }}" class="gf-btn-action" style="background-color: #FFD700; padding: 5px 10px; border-radius: 4px; margin-right: 5px;">
                            <i class="fas fa-eye" style="color: #14532d;"></i>
                        </a>
                        <a href="{{ route('procurement-requests.edit', $request->id) }}" class="gf-btn-action" style="background-color: #FFD700; padding: 5px 10px; border-radius: 4px; margin-right: 5px;">
                            <i class="fas fa-edit" style="color: #14532d;"></i>
                        </a>
                        <button class="gf-btn-action" style="background-color: #FFD700; border: none; padding: 5px 10px; border-radius: 4px;">
                            <i class="fas fa-file-export" style="color: #14532d;"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <button onclick="document.getElementById('newRequestForm').style.display='block'" 
    style="background-color: #FFD700; color: #14532d; padding: 10px 15px; border: none; border-radius: 6px; margin-bottom: 20px;">
    <i class="fas fa-plus"></i> New Request
</button>

    </table>

   <div class="gf-pagination" style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div style="color: #777; font-size: 14px;">
        Showing {{ $requests->firstItem() }} to {{ $requests->lastItem() }} of {{ $requests->total() }} requests
    </div>
    <div>
        {{ $requests->links() }}
    </div>
</div>
            <button style="background-color: #F5F5F5; border: 1px solid #DDD; padding: 5px 10px; margin: 0 5px;">Previous</button>
            <button style="background-color: #FFD700; color: #14532d; border: none; padding: 5px 10px; margin: 0 5px; font-weight: bold;">1</button>
            <button style="background-color: #F5F5F5; border: 1px solid #DDD; padding: 5px 10px; margin: 0 5px;">2</button>
            <button style="background-color: #F5F5F5; border: 1px solid #DDD; padding: 5px 10px; margin: 0 5px;">3</button>
            <button style="background-color: #F5F5F5; border: 1px solid #DDD; padding: 5px 10px; margin: 0 5px;">Next</button>
        </div>
    </div>
</div>