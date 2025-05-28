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
    <title>oscord.When you start learning programming.com</title>
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
                    line-height : 40px;
                    }
                    .main p div,h3,h4{
                        line-height : 40px;
                    }
            
       h3{
       		padding-bottom : 20px;             
       }
        
            
            
                    a{
            	color : #00ff15;
               
            }
            a:hover{
                font-size : 18px;    
               
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
     <div class='container main' ><p>
    <div><h3>Programming ကိုစတင်လေ့လာတော့မယ်ဆိုရင်ဘာတွေသိထားဖို့လိုအပ်လဲ</h3></div>
		
		<div>အရင်ဆုံးကတော့ ကိုယ်ကဘယ် Developing Field ထဲကိုသွားချင်သလဲဆိုတာစဉ်းစားဖို့လိုပါတယ်</div>

		<div>Developing Field တွေကတော့အများအပြားရှိတဲ့ထဲမှ စတင်လေ့လာမယ့်သူတွေအတွက် လောလောဆယ်ခေါင်းရူပ်မနေစေချင်တော့</div><div> General ဖြစ်တဲ့ Field သုံးခုကိုပဲဖော်ပြလိုက်ပါမယ်</div>

		<div>1. Desktop Application Development </div>
        <div>2. Web Application Development </div>
        <div>3. Android Application Development </div>

		<div>အိုကေပါ အထက်မှာဖော်ပြထားတဲ့ Developing Field သုံးခုကိုသိသွားပြီဆိုရင် ဘာကိုဆက်စဉ်းစားရမလဲဆိုတာကတော့</div><div>  ဘယ် Field ကိုသွားဖို့အတွက်ဆိုရင် ဘာတွေလေ့လာသင်ယူဖို့လိုအပ်သလဲဆိုတာပါ</div>

		<div>ဘာတွေလေ့လာဖို့လိုအပ်သလဲဆိုရင် Developfield တစ်ခုချင်းစီမှာ သေချာပေါက်သိထားရမယ့် အရာကတော့</div><div>  Programming Fundamental Concepts တွေနဲ့ Database Management System ပါ</div>

		<div>Fundamental Concepts တွေဆိုတာကတော့ Programming စလေ့လာတော့မယ်ဟေ့ဆိုတာနဲ့ သိကိုသိထားရမယ့်</div><div>  Programming Language တိုင်းမှာပါဝင်တဲ့ Concepts တွေပါ 
             
             </div><div> (Fundamental အပိုင်းကတော့ ဘယ် Developing Field ကိုပဲသွားသွား လိုကိုလိုအပ်ပါတယ်) </div>
                
        <div>သို့ပေမယ့် Language တစ်ခုရဲ့ Fundamental Concepts တွေကိုပိုင်နိုင်သွားပြီဆိုရင် Others Langauge တွေအတွက် </div><div> အလွယ်အကူအဆင်ပြေပြေနဲ့ လေ့လာနိုင်မှာဖြစ်ပါတယ် </div>
                
        <div>(Syntax ပဲကွဲပြီး Theory တူတူပဲမို့လို့ပါ)</div>

		<div><a href="oscord_database.php">Database Management System ဆိုတာဘာလဲ & ဘာလို့ Programmer တစ်ယောက်က Database ကိုလေ့လာဖို့လိုအပ်တာလဲ</a></div>

		<div>ကျန်တာတွေကတော့ Field အပေါ်မှာမူတည်ပြီး တစ်ခုချင်းစီမှာ လေ့လာရတဲ့ Language & Framework တွေအများအပြားရှိပါတယ်</div>

		<div>ဥပမာ Desktop Application တစ်ခုတည်ဆောက်မယ်ဆို C# သို့မဟုတ် Java ကိုအသုံးပြုကြပါတယ် </div>
                
              <div>  & Web Application Development အတွက်ဆိုရင်တော့ PHP , Python, Java , C# စတာတွေကိုအသုံးပြုပါတယ် </div>
                
              <div>  (အဲဒီနေရာမှာ မရောသွားစေချင်တာက ကျနော်တို့က အကုန်လုံးကိုလေ့လာထားစရာမလိုပါဘူး ဥပမာ Web အတွက်ဆို </div>
                
               <div> အပေါ်မှာဖော်ပြခဲ့တဲ့ Python , Java , C#, PHP စတာတွေထဲမှာမှ Java ကိုပဲသုံးပြီး Develop  လုပ်သွားမှာလား </div>
                
               <div> ဒါမှမဟုတ် PHP ကိုပဲသုံးသွားမလားဆိုတာတော့ ကာယကံရှင်ကပဲ ကိုယ်တိုင်ရွေးချယ်ရမှာဖြစ်ပါတယ်)</div>

		<div>ဒီနေရာမှာထပ်ပြီးမရောစေချင်စေတာကတော့ ရွေးချယ်ရမယ့်အပိုင်းမလာခင် </div>
                
              <div>  ကိုယ်က Fundamental Concepts တွေကိုသိထားမှအဆင်ပြေပါမှာ Fundamental Concept အပိုင်းတစ်ခုထဲကလည်း </div>
                
              <div>  Application Development Level အထိပေးစွမ်းနိုင်မှာမဟုတ်ပါဘူး (Application Development Level ထိသွားဖို့အတွက်ဆိုရင်</div>
                
              <div>  ကိုယ်ရွေးချယ်ထားတဲ့ Developing Field & ကိုယ်ရွေးချယ်ထားတဲ့ Langauge ရဲ့သက်ဆိုင်ရာဆက်လေ့လာရမယ့် နည်းပညာတွေရှိပါတယ် </div>
		
        <div>ဥပမာ ကိုယ်က Web Development ကို Java နဲ့သွားချင်တာလား ဒါဆို Java Fundamental ကိုအရင်သင်ယူပြီးရင် </div><div> J2EE , Java Spring  စတဲ့ Java ရဲ့ Advanced Technique  တစ်ခုကိုအသုံးပြုလို့ရပါတယ်)</div>

		
       <div> ဒီလောက်ဆိုသဘောပေါက်လောက်ပြီလို့ထင်ပါတယ် </div> 
                </p> 
    </div>
    
</body>