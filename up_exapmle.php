
<input type='file' name='inputfile' id='inputfile'>
<button onclick="send()">CHAP</button>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
function send(){
    var file_data = $('#inputfile').prop('files')[0];
        var form_data = new FormData();
        form_data.append('document', file_data);
        $.ajax({
            url: "api/upload_document.php?id=1",
            type: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                console.log(data);
            }
        });
}
</script>
