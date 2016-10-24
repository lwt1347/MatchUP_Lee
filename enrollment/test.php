

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>



</body>
</html>
<p>time : <span id="time"></span></p>





<input type="button" id="execute" value="execute" />

<script>
    document.querySelectorAll('input')[0].addEventListener('click', function(event){
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './teamNameCheck.php');

    xhr.onreadystatechange = function(){ //서버로부터 받아온 값을 뿌림
        document.querySelector('#time').innerHTML = xhr.responseText;
    }

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data = ''; //서버로 보낼 데이터

    data += '&format='+document.getElementById('format').value;
    alert(data);
    xhr.send(data); 
});

</script> 