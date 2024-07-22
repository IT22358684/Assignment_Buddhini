document.getElementById('name').addEventListener('input', function (e) {
    e.target.value = e.target.value.replace(/[^A-Za-z]/g, ''); 
});

document.getElementById('contact_no').addEventListener('input', function (e) {
    const input = e.target;
    const maxLength = 10;
    if (input.value.length > maxLength) {
        input.value = input.value.slice(0, maxLength);
    }
    input.value = input.value.replace(/\D/g, '');
});


    // document.getElementById('generateReport').addEventListener('click', function() {
    //     var startDate = document.getElementById('start_date').value;
    //     var endDate = document.getElementById('end_date').value;
    //     var url = "itemReportPDF.php?id=invoice&start_date=" + startDate + "&end_date=" + endDate;
    //     this.href = url;
    // });


