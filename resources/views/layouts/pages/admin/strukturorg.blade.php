@extends('master')

@section('body')
    <script src="https://balkan.app/js/OrgChart.js"></script>
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold"> STRUKTUR KEPENGURUSAN</h2>
                    <h5 class="text-white op-7 mb-2">Pondok Pesantren Ma'hadul 'Ilmi Asy-Syar'ie</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5" style="background-color: #033773">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="" style=""  id="tree"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
