<x-app-layout>
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item">Service View Result</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12">
                <div class="card card-table show-entire">
                    <div class="card-body">
                        <div class="page-table-header mb-2">
                            <div class="row">
                                <div class="col">
                                    <div class="doctor-table-blk">
                                        <h3><strong>{{ $data->booking->patient->name }}</strong> - ({{ $data->service->name }})</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table border-0 custom-table comman-table mb-0">
                                <thead>
                                    @if ($has_unit == true)
                                        <th>Test</th>
                                        <th>Result</th>
                                        <th>Unit</th>
                                    @elseif ($has_range == true)
                                        <th>Test</th>
                                        <th>Result</th>
                                        <th>Normal Range</th>
                                    @elseif ($has_both == true)
                                        <th>Test</th>
                                        <th>Result</th>
                                        <th>Unit</th>
                                        <th>Normal Range</th>
                                    @else
                                        <th>Test</th>
                                        <th>Result</th>
                                    @endif
                                </thead>
                                <tbody>
                                    @if ($has_unit == true)
                                        @foreach ($results as $res)
                                            <tr>
                                                <td>
                                                    {{ $res->results->name }}
                                                </td>
                                                <td>
                                                    {{ $res->result_value }}
                                                </td>
                                                <td>
                                                    {{ $res->results->units->name }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @elseif ($has_range == true)
                                        @foreach ($results as $res)
                                            <tr>
                                                <td>
                                                    {{ $res->results->name }}
                                                </td>
                                                <td>
                                                    {{ $res->result_value }}
                                                </td>
                                                <td>
                                                    {{ $res->results->range }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @elseif ($has_both == true)
                                        @foreach ($results as $res)
                                            <tr>
                                                <td>
                                                    {{ $res->results->name }}
                                                </td>
                                                <td>
                                                    {{ $res->result_value }}
                                                </td>
                                                <td>
                                                    {{ $res->results->units->name }}
                                                </td>
                                                <td>
                                                    {{ $res->results->range }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach ($results as $res)
                                            <tr>
                                                <td>
                                                    {{ $res->results->name }}
                                                </td>
                                                <td>
                                                    {{ $res->result_value }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
