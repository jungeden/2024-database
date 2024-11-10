<?
$userid = isset($_GET['userid']) ? $_GET['userid'] : '';

echo("
    <head>
        <style>
        @import url(about.css);
        @import url(start.css);
        @import url(login.css);
        @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
        a {text-decoration: none;}
    </style>

    </head>
    <body>
        <div class='container about'>
            <div class='top about'>
                <div class='lefttop'>
                    <div class='title '>
                        <a  class='title' href='startPage.php?userid=$userid'>TITLE</a>
                    </div>
                </div>
                <div class='righttop'>
                    <div class='label'>
                        <a class='labeltext'>TESTTEXT</a>
                    </div>
                    <div class='label second'>
                        <a class='labeltext'>TESTTEXT</a>
                    </div>
                </div>
            </div>
            <div class='middle about'>

            </div>
            <div class='bottom about'>

            </div>

        </div>
    </body>
    
");


?>
<script>
const container = document.querySelector('.container.about');
const labels = document.querySelectorAll('.label, .label.second');

container.addEventListener('mouseenter', () => {
  labels.forEach(label => {
    label.style.height = '300px';  
  });
  labels.forEach(label => {
    if (label.classList.contains('second')) { 
      label.style.height = '330px';  
    }
  });
});


container.addEventListener('mouseleave', () => {
  labels.forEach(label => {
    label.style.height = '0px';  
  });
});

labels.forEach(label => {
  label.addEventListener('mouseenter', () => {
    label.style.height = parseInt(label.style.height) + 20 + 'px';
  });

  label.addEventListener('mouseleave', () => {
    label.style.height = parseInt(label.style.height) - 20 + 'px';  // Restore to the container hover height
  });
});

</script>