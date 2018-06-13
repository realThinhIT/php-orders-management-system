$(function() {
  var table = $('.dtbl').DataTable({
    dom: 'Bfrtip',
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Vietnamese.json"
    },
    buttons: [
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdfHtml5'
    ]
  });
});