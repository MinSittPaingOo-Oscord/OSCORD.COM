<?php
    include "connectdb.php";

 	#selecting course name
    $query1 = "SELECT courseID,courseName FROM oscord_course";
    $result1 = $conn->query($query1);

	if( isset($_POST['courseID'])){
		$id = $_POST['courseID'];

		#echo "Your id is ".$id;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>oscord.what is database.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        
         body, html {
    		height: 100%; 
   	 		margin: 0;  
                 
		}

		body {
    		background-color : black;
    		background-attachment: fixed; 
    		background-size: 400% 400%;  
    		height: 100%;  
		}

	
    	.navbar-custom {
              background-color: black;
            font-size: 18px; 
         }

        .navbar-custom .nav-link {
            color: white !important;
        }

        .navbar-custom .nav-link:hover {
            color: #ccc !important;
        }
        	
         .dropdown-menu{
            background-color : black;
        }
            
        .dropdown-item{
            background-color : black;
            font-size : 18px;
            color : white;
        }
        	
        .dropdown-item : hover{
            color : #ccc !important
        }    
        
        .main{
           color : white;
           padding : 30px;
         }
        
            .main div{
                    margin-bottom : 15px;
                    }
            
       h3,h4{
       		padding-bottom : 20px;             
       }
            
            hr{
                padding-bottom : 10px;
            }
    </style>
</head>
<body>
<ul class="nav nav-pills navbar-custom">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="oscord_home.php">OSCORD - Programming & Computer Science</a>
        </li>
        <form method='post' action='oscord_specificCoursePage.php'>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Courses</a>
            <ul class="dropdown-menu">
                <?php
                    if ($result1 && $result1->num_rows > 0) {
                        while ($row = $result1->fetch_assoc()) {
                            echo " <li><button class='dropdown-item' type='submit' name='courseID' value='".$row['courseID']."'>".$row['courseName']."</button></li>";
                        }
                    }
                   
                ?>
            </ul>
        </li>
        </form>
            
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Knowledge Sharing</a>
            <ul class="dropdown-menu">
                  <li><a class='dropdown-item' href="oscord_startLearningProgramming.php">When you start learning Programming</a></li>
                  <li><a class='dropdown-item' href="oscord_webDevelopment.php">Web Development</a></li>
                  <li><a class='dropdown-item' href="oscord_database.php">What is Database?</a></li>
                  <li><a class='dropdown-item' href="oscord_AI.php">What are Data Science, Machine Learning, Artificial Intelligence, Deep Learning?</a></li>
            </ul>
        </li>
        
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Control</a>
            <ul class="dropdown-menu">
                  <li><a class='dropdown-item' href="oscord_instructorControlLogin.php">Instructor</a></li>
                  <li><a class='dropdown-item' href="oscord_studentControlLogin.php">Student</a></li>
            </ul>
        	</li>
        
       	<?php
            echo "<li class='nac-item ms-auto'>
            		<a class='nav-link' aria-current='page' href='oscord_signUpPage.php'>Sign Up</a>
            </li>";  
        ?>
    </ul>
     <div class='container main' >
    		<div><h3>Database ဆိုတာဘာလဲ။<br><br>
			
     		Programmer တစ်ယောက်ကဘာလို့ Database ကိုလေ့လာဖို့လိုအပ်တာလဲ။</h3></div>
		
			<div>Database ဆိုတာ အလွယ်ပြောရရင်တော့ စာရင်းစာအုပ်ကြီး တစ်အုပ်လိုပါပဲ။ </div>

			<div>အချက်အလက်တွေအများကြီးကို စနစ်တကျ စီမံပြီး သိမ်းဆည်းလို့ရတဲ့ နေရာကြီးတစ်ခုပေါ့။</div>

			<div>ကုန်ဆုံဆိုင်၊စတိုးဆိုင်၊စားသောက်ဆိုင်၊ဟိုတယ် အစရှိတဲ့ စီးပွားရေးလုပ်ငန်းအများစုဟာ ...</div>

			<div>သူတို့ရဲ့ လုပ်ငန်းနဲ့ဆိုင်တဲ့ အချက်အလက်တွေကို ‌Database ထဲမှာ သိမ်းဆည်းထားခြင်းအားဖြင့် Data ပျောက်ဆုံးခြင်းမရှိ‌တော့ဘဲ</div>
 
            <div>ထို Data ‌တွေကို ပြင်ဆင်ခြင်း၊ထပ်တိုးခြင်း၊ဖျက်ခြင်း စသည်တို့ကို Program ကနေတဆင့် လုပ်ကိုင်လို့ရပါတယ်။</div>
		<br>
			<hr>

			<div>Program ကနေတစ်ဆင့် လို့ပြောတဲ့နေရာမှာ Programmer သမားများဟာ အသုံးပြုမယ့် Database ကို </div><div> Code နဲ့ချိတ်ဆက်ပြီး Program ရေးပေးရပါတယ်။</div>
		
			<div>Computer မှာ အဓိကအားဖြင့် Memory နှစ်မျိုးနှစ်စားရှိပါတယ်။</div>

			<div>- Primary Memory(Main Memory)</div>
             
			<div>- Secondary Memory(External Memory)</div>

			<div>တို့ဖြစ်ပါတယ်။</div>

		 	<div>Primary Memory လို့ခေါ်တဲ့ Main Memory ဟာ Computer တစ်လုံးကို အသုံးပြုလည်ပတ်နေတဲ့ အချိန်မှာပဲ Data တွေကို Store လုပ်ပါတယ်။</div>

			<div>အသုံးပြုနေတဲ့ Computer ကို Shut Down ချလိုက်တဲ့အခါ တစ်နည်းအားဖြင့် လျှပ်စစ်ပြတ်တောက်သွားတဲ့အခါ</div><div>  Primary Memory ပေါ်မှာ ရှိတဲ့ Data တွေဟာ ရုတ်ချည်းပျောက်ကွယ် သွားမှာဖြစ်တယ်။</div>

			<div>Secondary Memory ကတော့ Long Term အတွက်ရည်ရွယ်အသုံးပြုပါတယ်။ Second Memory ထဲမှာ ရှိတဲ့ Data & Instructions တွေဟာ </div>
                    
                 <div>   လက်ရှိအသုံးပြနေတဲ့ Computer က Power Off သွားလည်း ပျောက်ဆုံးခြင်းရှိမှာ မဟုတ်ပါဘူး။</div>

			<div>ဆိုကြပါစို့ Program တစ်ခုရှိမယ်။ Variables တွေ Declare လုပ်ထားမယ်။ User Input တောင်းတယ်။</div><div> ရလာတဲ့ User Input တွေကို Variables ‌ထဲမှာ သွားပြီး Store လုပ်တယ်။</div>

			<div>ဒီမှာဆိုရင် User ဆီကနေ ရရှိလာတဲ့ Data တွေဟာ Variables တွေမှာ Assign ၀င်သွားပါတယ်။ </div><div>ထို Variable တွေဟာ Computer ရဲ့ Primary Memory မှာသာ တည်ရှိပါတယ်။</div>

			<div>စက်ပိတ်လိုက်ရင် (သို့မဟုတ်) Program ကို နောက်တစ်ကြိမ် ပြန် Run မယ်ဆိုရင် အရှေ့က Assign  ၀င်ထားတဲ့ တန်ဖိုးတွေဟာ</div><div> ပျောက်ဆုံးသွားမှာဖြစ်တယ်။ တန်ဖိုးအသစ်ကို ပြန်လည် Input ပေးရမှာဖြစ်တယ်။</div>

			<div>အမှန်တကယ် စီးပွားရေးလုပ်ငန်းတွေအတွက် Program ရေးပေးတော့မယ်ဟေ့ ဆိုရင် </div><div>ဒီလိုမျိုး User Input ကရလာမယ့် အချက်အလက်‌တွေဟာ ပျက်စီးသွားလို့မဖြစ်ပါဘူး။</div>

			<div>စီးပွားရေးလုပ်ငန်း‌တွေဟာ သူတို့ဆီမှာ ရှိတဲ့ အချက်အလက်တွေကို နှစ်ရှည်ကြာအောင် သိမ်းဆည်းချင်တာဖြစ်ပါတယ်။ </div>
			
            <div>ဒါကြောင့်မလို့ အချက်အလက်တွေကိုသိမ်းဆည်းပေးရတဲ့အခါမှာ Computer ရဲ့ Secondary Memory မှာ </div><div>File (သို့မဟုတ်) Database တစ်ခုအနေနဲ့ သွားပြီးသိမ်းဆည်းရပါတယ်။</div>
			
            <div>Programmer တွေဟာ သူတို့ဆီလာတဲ့ Customer  ရဲ့ စီးပွားရေးလုပ်ငန်းတွေအတွက် Application တစ်ခုရေးပေးတော့မယ်‌ဆိုရင်</div><div> လုပ်ငန်းအကြောင်းနားလည်အောင်လုပ်ပြီး Database design တည်ဆောက်ပေးရပါတယ်။ </div>

			<div>Data တွေကို ဘယ်လိုသိမ်းချင်တာလဲ၊ ဘယ်လို Operations တွေကို လုပ်ကိုင်‌ချင်တာလဲ၊ အစရှိသဖြင့် Customer လုပ်ငန်းကို မေးမြန်းရပါတယ်။ </div>

			<div>မေးမြန်းပြီးမှသာ Database တစ်ခုကိုတည်ဆောက်ပြီး Code နှင့် ချိတ်ဆက်ကာ Application တစ်ခု ဖန်တီးပေးရတာ ဖြစ်ပါတယ်။</div>

			<div>ဒီလိုမျိုး Application မှာ Database ကို အသုံးပြုခြင်းအားဖြင့် Application ကို အသုံးပြုမယ့် User က</div>

			<div> Data တွေကိုသိမ်းဆည်းနိုင်သွားမယ်။</div>
			
             <div>သိမ်းဆည်းထားတဲ့ Data တွေကို ပြင်မှာလား</div>
			
             <div>ပြန်ဖျက်မှာလား</div>
			
             <div>Data အသစ်ထပ်တိုးမှာလား </div>
			
             <div>Database ထဲကနေ ကိုယ်လိုချင်တဲ့ Data ကိုပဲ ရှာမှာလား</div>
			
             <div>Data တွေကို ကိုယ်လိုချင်သလို စီစဉ်မယ်၊ ထိန်းချုပ်မယ်</div>
			
             <div>စသဖြင့် Data Management ကို လုပ်‌ကိုင်နိုင်သွားမယ်။</div>

			 <div>ဒါကြောင့်မလို့ Programmer တစ်ဦးဟာ Database ကို အသုံးပြုတတ်သူဖြစ်ရပါမယ်။</div>
<div></div>
                    <hr>
			<div><h4>Database server အမျိုးအစားများ</h4></div>

			<div>-SQL Server(Microsoft SQL)</div>
			
             <div>- Oracle</div>
			
             <div>- My SQL Server</div>
			
             <div>- Aurora</div>

				<div>SQL Server သို့မဟုတ် Microsoft SQL Server ဟာ Business နှင့် Organization တွေမှာ </div>
             
             <div>အသုံးပြုတဲ့ Database Management System တစ်ခုဖြစ်ပါတယ်။</div>

             <div>တစ်နည်းအားဖြင့် Desktop Application တွေမှာသုံးပါတယ်။ </div>
             
             <div>စီးပွားရေးလုပ်ငန်းတွေဟာ Desktop Application ကိုပိုမိုတွင်ကျယ်စွာ အသုံးပြုပါတယ်။</div>

             <div>Data warehousing, Business intelligence and Analytics စတဲ့ နေရာတွေမှာ အသုံးပြုကြပါတယ်။</div>

			<div>My SQL ကတော့ Web Application & Website တွေရေးတဲ့နေရာမှာ အသုံးပြုတဲ့ Database Management System တစ်ခုဖြစ်ပါတယ်။ </div>
             
            <div>အသုံးပြရလွယ်ကူတယ်၊ မြန်ဆန်တယ်၊ ဖတ်လို့ရူလို့လွယ်တယ် ဒါတွေကြောင့် လူသိများကြပါတယ်။</div>

			<div>ကျန်တဲ့ Database server အမျိုးအစားတွေကလည်း သူနေရာနဲ့သူ အသုံးပြုကြတဲ့</div><div> အသုံး၀င်ကြတဲ့ Database Management System တွေဖြစ်ပါတယ်။</div>
<div></div>
                    <hr>
<div><h4>Programmer တွေအတွက် Database ကို ‌လေ့လာသင့်တဲ့ အခြားသော အကြောင်းအရင်း</h4></div>

<div>Job Opportunities & Valuable Asset of Industries</div>

            <div> Career Advancement in Data Science & Business Intelligence</div>

<div>ယနေ့ခေတ်ဟာ Data-driven world ဖြစ်ပါတယ်။</div>
             
<div>အပေါ်မှာရှင်းပြသွားသလိုပဲ။ Data ‌တွေကို သိမ်းဆည်းပြီး အလုပ်လုပ်ကိုင်ကြတာပါ။</div>
             
<div>Database ကို လေ့လာထားတယ်၊ Database knowledge ရှိတယ်ဆိုရင် သင်ဟာ အလုပ်အကိုင်အခွင့်အလမ်းပေါများမှာဖြစ်ပါတယ်။</div>

<div>ဒါဆိုရင် Database ကိုဘာကြောင့်သုံးတယ်၊ ဘယ်နေရာတွေမှာသုံးတယ်၊ Database ကိုဘာကြောင့်လိုအပ်တယ် </div><div>ဒါတွေကိုသိသွားပြီလို့ထင်ပါတယ်။</div>
             
 	</div>
        
        
        
        
        
   
</body>