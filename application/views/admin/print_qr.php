<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Print QR</title>
    <style type="text/css" media="print">
    @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }
    body { margin: 1cm; }
    </style>
</head>
<body onload="window.print()" style="width: 200px; height: 220px; overflow: hidden; border: solid;">
	<center><span style="margin-top: 10px;"><?=$param['code']?></span></center>
	<img src="<?=base_url().$param['qr_image'];?>" alt="Italian Trulli" width="200" height="200">
</body>