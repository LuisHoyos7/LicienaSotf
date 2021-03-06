@extends('layouts.metronic')
@section('content')
    @include('inscripciones.table')

    <script>
  $(document).ready(function() {
    $('#inscripciones').dataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Reporte Duarios'
            },
            {
                extend: 'pdfHtml5',
                title: 'Reporte  Diarios',
                exportOptions: {
                    columns: [0,1,2]
                }
            }
        ]
    } );
} );

</script>
@endsection
