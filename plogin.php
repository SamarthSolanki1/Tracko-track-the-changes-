 <!--    <!DOCTYPE html>
 -->    <html lang="en">
    <head>
        <title>Tracko-Track the changes</title>
    
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="https://apps.elfsight.com/p/platform.js" defer></script>
    <div class="elfsight-app-6f59b77e-213b-44d8-888e-5dff20beff09"></div> <!--Stylesheet-->
        <style media="screen">
        *,
    *:before,
    *:after{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
    body{
        background-image: url('map.png');
        background-repeat:repeat;
        background-size: 100%;

    }
    
    
    form{
        height: 80%;
        width: 65%;

        background-color: rgba(255,255,255,0.13);
        position: absolute;
        transform: translate(-50%,-50%);
        top: 50%;
        left: 50%;
        border-radius: 20px;
        backdrop-filter: blur(60px);
        border: 2px solid rgba(255,255,255,0.1);
        box-shadow: 0 0 40px rgba(8,7,16,0.6);
        padding: 15px 40px 15px 40px;
    }
    form *{
        font-family: 'Poppins',sans-serif;
        color: #000000;
        letter-spacing: 0.5px;
        outline: none;
        border: none;
    }
    form h4{
       
        text-align: center;
    }

    label{
        display: block;

        margin-top: 20px;
        font-size: 20px;
        font-weight: 500;
    }
    input{
        display: block;
        height: 40px;
        width: 70%;
        border-radius: 3px;
        
        margin-top: 8px;
        font-size: 14px;
        font-weight: 300;
    }
    ::placeholder{
        color: grey;
        text-align: center;
    }
    #submit{

        margin-top: 50px;
        margin-left: 320PX;
        width: 30%;
        background-color: #bbbbbb;
        color: #000000;
        padding: 10px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }
    
    .social{
    margin-top: 30px;
    display: flex;
    }
    .social div{
    background: red;
    width: 150px;
    border-radius: 3px;
    padding: 5px 10px 10px 5px;
    background-color: rgba(255,255,255,0.27);
    color: #000000;
    text-align: center;
    }
    .social div:hover{
    background-color: rgba(255,255,255,0.47);
    }
    .social .fb{
    margin-left: 25px;
    }
    .social i{
    margin-right: 4px;
    }

        </style>
    </head>
    <body >
    <form action="authen.php" method ="post"  name="f1"   >
            <h4 ><img src="tracko_logo.png" style="height: 25%; width: 30%;"> </h4>
<hr style="height:2px;border-width:0;color:gray;background-color:gray">
           <div class="content">
            <label for="username" style="text-align: center;">DEVICE ID:</label>
            <input type="text" placeholder="ENTER DEVICE ID: like-GJ00XY0000" id="username" name = "user" style="margin-left: 140px;" required>

            <label for="password"style="text-align: center;">Password</label>
            <input type="password" placeholder="ENTER PASSWORD" id="password" name ="pass" style="margin-left: 140px;" required>

            <input type = "SUBMIT" id ="submit">
            </div>
        </form>
        
    </body>
    </html>
