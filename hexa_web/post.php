<html>
<head>

    <script type="text/javascript">
        function sampleForm( value ){
            var form = document.createElement( 'form' );
            document.body.appendChild( form );
            var input = document.createElement( 'input' );
            input.setAttribute( 'type' , 'hidden' );
            input.setAttribute( 'name' , 'name' );
            input.setAttribute( 'value' , value );
            form.appendChild( input );
            form.setAttribute( 'action' , 'post_recieve.php' );
            form.setAttribute( 'method' , 'post' );
            form.submit();
        }
    </script>
</head>
<body>
<a href="#" onclick="sampleForm('samplepost');return false;">クリックしたら“samplepost”をPOST送信</a>
<a href="#" onclick="alert('出た！');return false;">いでよ！</a>
</body>
</html>