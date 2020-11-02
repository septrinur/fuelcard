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
    </style>
</head>
<body onload="window.print()">
	<img src="<?=base_url().$param['qr_image'];?>" alt="Italian Trulli">
</body>