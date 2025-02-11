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
            
       <div><h3>  How to be an AI engineer? What is AI ?</h3></div>

		<div>AI(Artificial Intelligence) ဆိုတာကတော့အားလုံးသိတဲ့အတိုင်း စက်ကိုလူသားရဲ့အကူအညီမပါဘဲနဲ့ </div>
            
           <div> ကိုယ်တိုင် ဆုံးဖြတ်နိုင်စွမ်းရှိတဲ့ လူလုပ်အသိဉာဏ်တစ်ခုလိုပြောလိုရပါတယ်</div>

	<div>	ဘယ်ကနေစပြီးလေ့လာရမလဲ</div>
		
      <div>  - Mathematics(Linear Algebra, Probability, Calculus)</div>
		
     <div>   - Statistics (စာရင်းအင်းပညာ)</div>
		
      <div>  - Programming (Mostly Python)</div>
		
      <div>  - Machine Learning</div>

		<div>ဒါတွေကနေစပြီးလေ့လာဖိုလိုအပ်ပါတယ်</div>
            
		<div>အဲဒီထဲမှာမှ Mathematics & Statistics ဟာဆိုရင် Data Science ဘက်မှာအဓိကအသုံးချပါတယ် </div>
            
       <div> Programming ကတော့ Physically AI Traning လုပ်တဲ့နေရာမှာ </div>
            
       <div>	အများအားဖြင့် Python ကိုအသုံးပြုတာဖြစ်တဲ့အတွက် လေ့လာဖိုလိုတာဖြစ်ပါတယ်</div>

		<div>AI engineer တစ်ဦးဖြစ်လာဖိုဆိုရင် Data Scientist + Software Engineer = AI Enginner ဆိုတာကိုလဲနားလည်ဖိုလိုပါတယ်</div>

            <br><hr>
            
		<div><h4>So What Is Data Science ? </h4></div>

         <div>Data Science နဲ့ပတ်သက်ပြီးအရင်ရှင်းပြပါမယ်</div>
            
		<div>အားလုံးမြင်တွေ့လှုပ်ရှားသွားလာနေတဲ့ လူ့အဖွဲအစည်းထဲမှာ လူတစ်ဦးတစ်ယောက်ချင်းစီ</div>
            
       <div> အသက်မွေးလုပ်ကိုင်နေကြတဲ့ လုပ်ငန်းတစ်ခုချင်းစီရှိကြပါတယ်</div>

		<div>ဘယ်လုပ်ငန်းမှာမဆိုသည် လုပ်ငန်းကြီးရင်ကြီးသလောက် သူတိုလုပ်ငန်းစဉ်မှာရှိတဲ့ အချက်အလက် Data တွေကို </div>
            
         <div>ကောင်းကောင်းမွန်မွန် Handle လုပ်နိုင်ဖိုလိုအပ်ပါတယ်</div>

		<div>ဥပမာ ဈေးဆိုင်တစ်ခုမှာဆိုရင် ထားရှိတဲ့ကုန်ပစ္စည်းအချက်အလက်တွေ </div>
            
        <div>ဈေးနှုန်းတွေ Customer အချက်အလက်တွေ အရူံးအမြတ်စာရင်းတွေ စသဖြင့် </div>
            
        <div> Data တွေကို Systematically Store လုပ်ပြီး Handle နိုင်ဖိုလိုအပ်ပါတယ်</div>

		<div>ဒီလို Data Handle တဲ့နေရာမှာ လုပ်ငန်းသေးရင်တော့ စာအုပ်ပေါ်ချမှတ်တာဖြစ်ဖြစ် </div>
            
        <div>IT နဲ့အကျွမ်းတဝင်ရှိတဲ့လူဆိုရင် excel ကိုအသုံးပြုတာပဲဖြစ်ဖြစ် ဆိုရင်အဆင်ပြေပါတယ် </div>
            
		<div>လုပ်ငန်းအနည်းငယ်ပိုပြီး operation ကကြီးမားလာတဲ့အခါ </div>
            
           <div> database ကိုအသုံးပြုပြီး ရေးထားတဲ့ Software တွေကိုအသုံးပြုလာကြပါတယ်</div>

		<div>Business Operation ကအရမ်းအရမ်းကိုကြီးမားသွားပြီဆိုရင်တော့ </div>
            
         <div> Data Science ပညာကိုတတ်မြောက်ထားတဲ့ Data Scientist တွေရဲ့အကူအညီကိုလိုအပ်လာပြီဖြစ်ပါတယ်</div>

		<div>Data Scientist တွေဟာ ဘာကိုအဆင့်ဆင့်လုပ်ဆောင်သွားရလဲဆိုတာရှင်းပြပါမယ်</div>

	<div>ပထမဦးဆုံးမှာ Operation မှာဖြစ်နေတဲ့ Business Problem ကိုသိအောင်လုပ်ရပါတယ်</div>
            
           <div> ပြီးရင် လုပ်ငန်မှာရှိနေတဲ့ Data တွေကို Collection လိုက်စုစည်းရပါတယ်</div>

	 <div>စုစည်းထားတဲ့ Data တွေဟာအရမ်းကိုများပြားတဲ့အတွက်ကြောင့် စနစ်တကျမရှိနေနိုင်ပါဖူး</div>
            
            <div>Duplicate ဖြစ်နေတာတွေ နေရာတလွဲဖြစ်နေတာတွေ စသဖြင့်ပွစကြဲနေတတ်ကြပါတယ်</div>

		 <div>ပွစကြဲနေတဲ့ Data တွေကို Collect လုပ်တဲ့အပြီးမှာ Data Cleaning လုပ်ပေးရပါတယ် </div>
            
            
	<div>အဲဒါပြီးရင် Data Analysis လိုဆိုတဲ့ Data တွေကိုခွဲခြမ်းစိတ်ဖြာပေးရပါတယ် </div>
            
            <div>ဒီနေရာမှာ Data Analyst  လိုခေါ်တဲ့ Job တစ်ခုကထပ်ပြီးတိုးလာပါတယ် </div>
            
           <div> Analysis ပိုင်းပြီးသွားရင်တော့ Data Science နည်းပညာတွေဖြစ်တဲ့ </div>
            
		<div>Statistics(စာရင်းအင်းပညာ), Mathematics စတာတွေကိုအသုံးပြုပြီး</div>
            
          <div>  Data တွေကို ကိုယ်လိုချင်တဲ့ Format အတိုင်း ဖန်တီးထုတ်လုပ်ပါတော့တယ်</div>

		<div>ဒီအတွက် Data Scientist တွေသည် Business point of view မှာပိုပြီး အားသာကြပါတယ် </div>
            
            <div>Statistics, Mathematics  ဒါတွေကိုပိုပြီး ကျွမ်းကျင်တတ်မြောက်ဖိုလိုပါတယ်</div>

		<div>ဒါဆို AI Engineer နဲ့ရောဘာဆိုင်တာလဲ</div>

<div>- AI Enginner တစ်ယောက်ဖြစ်လာဖိုဆိုရင်အပေါ်မှာပြောခဲ့တဲ့ Data Science ကို တစ်ဖက်ကမ်းထိတတ်မြောက်ထားဖိုတော့မလိုအပ်ပါဖူး</div>
            
<div>- Data Science မှာလေ့လာဖိုလိုအပ်တာတွေကို အခြေအနေတစ်ခုအထိတတ်မြောက်ပြီးရင် </div>
            
         <div>   Machine Learning, Programming ဘက်ကိုဦးစားပေးလေ့လာရမှာဖြစ်ပါတယ်</div>
            
<div>ဘာလို.Machine Learning, Data Science တွေက AI engineering နဲ့ဆက်စပ်နေတာလဲဆိုတာ နားလည်ဖို Deep Learning ဆိုတာဘာလဲ </div>
            
          <div>  Machine Learning ဆိုတာဘာလဲဆိုတာတွေကိုဆက်လက်ဖတ်ရူပေးပါ</div>
            
            <div class='row'>
            	<div class='col'><a href='oscord_AI.php'>Back</a> </div>
                <div class='col'><a href='oscord_ai2.php'>Next</a>  </div>
            </div>
      
 	</div>
        
        
   
</body>