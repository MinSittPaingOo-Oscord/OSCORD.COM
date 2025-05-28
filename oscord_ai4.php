<?php
    include "connectdb.php";

    $query1 = "SELECT courseID,courseName FROM oscord_course";
    $result1 = $conn->query($query1);

	if( isset($_POST['courseID'])){
		$id = $_POST['courseID'];

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>oscord.ai.com</title>
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
            a{
            	color : #00ff15;
               
            }
            a:hover{
                font-size : 20px;    
               
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
        
	
 	<div class="container main">
            
 	<div><h4>AI Revolution</h4></div>
            
<div>AI ကအနာဂတ်မှာ Developer တွေကိုအစားထိုးသွားမှာလား</div>
            
<div>အခြားလုပ်ငန်းတွေကိုမှာရော Worker တွေအပေါ်မှာအစားထိုးသွားမှာလား</div>
            
 <div>အခုဆိုရင် AI ရဲ့လုပ်နိုင်စွမ်းနဲ့ တိုးတက်လာမူတွေကို အားလုံးမျက်မြင်ကိုယ်တွေ့တွေ့ခဲ့ပြီးဖြစ်တယ် </div>
            
            <div>ဒီအတွက်လဲ စိုးရိမ်စရာတွေဖြစ်နေကြတယ်ပေါ့</div>
            
<div>AI ကတကယ်ပဲ လူတွေကိုလွမ်းမိုးသွားမှာလား</div>
            
<div>လူတွေရဲ့အကူအညီတွေလုံးဝမလိုအပ်ဘဲနဲ့ ရှင်သန်ကြတော့မှာလားဆိုတော့ </div>
            
<div>မဟုတ်သေးပါဖူးလိုပဲပြောရမှာဖြစ်ပါတယ်</div>
            
<div>AI ကဘယ်လောက်ပဲလုပ်နိုင်လုပ်နိုင် လူလိုချင်တာကိုမသိတာဖြစ်တဲ့အတွက် </div>
            
           <div> နောက်ပြီးလူ့ခံစားချက်အတိုင်းလိုက်မခံစားနိုင်တဲ့အတွက် အဓိကက AI ကအခုထိ </div>
            
           <div> လူကသာ Train ပေးနေရတာဖြစ်တဲ့အတွက် AI ကသူ့ဘာသူ Train ပြီး</div>
            
            <div>လူတွေနေရာမှာအစားထိုးဖိုကိုတော့ Century တစ်ခုလောက်ထိ စိတ်ချလိုရတယ်ဆိုတာကိုပြောနိုင်ပါတယ်</div>
            
<div>AI ကအခုချိန်မှာတော့လူသားတွလုပ်ဆောင်နေတဲ့ Task တွေကို ပိုပြီးလွယ်ကူမြန်ဆန်ကောင်းမွန်အောင်</div>
            
            <div>ကူညီပေးတဲ့နေရာမှာအများကြီးအထောက်အကူဖြစ်လာပြီပဲဖြစ်ပါတယ်</div>
            
<div>သိုပေမယ့် AI ကလုပ်ပေးနိုင်တဲ့အလုပ်တွေကို ကိုယ်က General ထက်ပိုပြီးတတ်ကျွမ်းထားနိုင်ဖိုလိုအပ်ပါတယ်</div>
            
<div>ဥပမာ Developer တွေဆိုရင် အရင်ကထက် အနည်းငယ်တော့ Challenging ဖြစ်လာပါတယ်</div>
            
 <div>ဘာလိုလဲဆိုတော့ Level တစ်ခုထိလုပ်နိုင်စွမ်းရှိနေတာဖြစ်တဲ့အတွက်ကိုယ်က </div>
            
           <div> General Level ထက်ပိုပြီးသာလွန်နေဖိုတော့လိုအပ်ပါလိမ့်မယ်</div>

 <div>ဒါဆိုရင်တော့ Artificial Intelligence, Data Sceince, Machine Learning, Deep Learning </div>
            
            <div>ဒါတွေကိုနားလည်သဘောပေါက်လောက်ပြီလိုထင်ပါတယ်</div>

     
            
            <div class='row'>
            	<div class='col'><a href='oscord_ai3.php'>Back</a> </div>
            </div>
      
 	</div>
        
        
   
</body>