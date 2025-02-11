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
            
 	<div><h4>What Is Machine Learning ? Artificial Intelligence နဲ့ဘယ်လိုဆက်စပ်နေသလဲ</h4></div>

	<div>Machine Learning ဆိုတာ Artifical Intelligence ရဲ့အစိတ်အပိုင်းတစ်ခုဖြစ်ပါတယ် </div>
            
    <div>စက်တွေကိုလူတွေအတိုင်း စဉ်းစားနိုင်အောင် လုပ်ပေးတဲ့ Function တွေ နည်းပညာတွေကို ပြောတာဖြစ်ပါတယ်</div>

	<div>ဒါကိုနားလည်ဖို့ဆိုရင် Traditional Programming နဲ့ Machine Learning ကိုကွဲကွဲပြားပြားနားလည်ဖို့လဲလိုအပ်ပါတယ်</div>

 	<div>ဥပမာ လူတစ်ယောက်က ထမင်းကြော်နည်းကိုသိတယ် </div>
            
           <div> သူ့လက်ထဲမှာလဲထမင်းဆိုတာကြီးကရှိနေတယ်ဆိုရင် </div>
            
            
            <div>သူသာထမင်းကြော်လိုက်တယ်ဆိုရင် ထမင်းကြော်တစ်ပွဲထွက်လာမှာဖြစ်ပါတယ်</div>

 	<div>Traditional Programming မှာဆိုရင်လည်းဒီလိုပါပဲ </div>
            
           <div> Input တစ်ခုရှိမယ် Function တစ်ခုရှိမယ်ဆိုရင် </div>
            
           <div> Function ထဲက Action အပေါ်မှာမးတည်ပြီးတော့ Output တစ်ခုထွက်လာမှာဖြစ်ပါတယ် </div>

	<div>လူနားလည်အောင်ပြောရမယ်ဆိုရင်တော့ ထမင်းဆိုတာက Input </div>
            
           <div> ထမင်းကြော်နည်းက Function</div>
            
           <div> ထမင်းကြော်လိုက်တာက Function ထဲက Action  </div>
            
            <div>ထွက်လာတဲ့ ထမင်းကြော်က Output ဖြစ်ပါတယ် </div>
            
           <div> ဒါကသာမာန်ရိုးကျ Programming ပါ</div>

		<div>Machine Learning မှာကကြတော့ </div>
            
            <div>ဥပမာ လူလိုပြောရမယ်ဆိုရင် အဲဒီလူက ထမင်းကြော်နည်းမရှိသေးတဲ့ </div>
            
           <div> ထမင်းမကြော်တတ်သေးတဲ့လူသားတစ်ယောက်ဖြစ်နေပါသေးတယ်</div>
            
		<div>ဒါပေမယ့် သူ့လက်ထဲကို ထမင်းရယ် ကြော်ထားပြီးသား ထမင်းကြော်ရယ်ကို ထည့်ပေးလိုက်မယ်ဆိုရင်</div>
            
           <div> ထမင်းနဲ့ထမင်းကြော်ကိုခွဲခြားနိုင်ပါတယ်</div>
            
           <div> ဒါဟာစက်တွေမှာဆိုရင်လဲ Deep Learning တုန်းက ဘယ်ဟာကိုဘာမှန်းသိအောင်လုပ်ထားလို့ သိသလိုပါပဲ</div>
            
		<div>ဒါဆိုဟုတ်ပြီ အဲဒီထမင်းမကြော်တတ်သေးတဲ့လူကို မတူညီတဲ့ထမင်းအမျိုးအစားတွေရယ်</div>
            
          <div>  အဲဒီထမင်းတွေကိုကြော်ထားတဲ့ မတူညီတဲံ့ထမင်းကြော်အများကြီးတွေကို အစုံအစုံလိုက် (ထမင်း + ထမင်းကြော်) </div>
            
           <div> တစ်နည်းအားဖြင့် (​Input + Output) နှစ်ခုတွဲပြီး Data တွေအများကြီးပေးလိုက်မယ်ဆိုရင် </div>
            
           <div> အဲဒီလူက ထမင်းကြော်နည်းကို သူဘာသာသူအကြိမ်ပေါင်းများစွာကြော်ကြည့်ရင်းနဲ့ </div>
            
           <div> နောက်ဆုံး ထမင်းကြော်နည်းအမှန်ကိုသိသွားမှာဖြစ်ပါတယ် ဒါဆိုရင်နောက်အကြိမ်တွေကြရင် </div>
            
           <div> ဘယ်လိုထမင်းအမျိုးအစားကိုပဲသူ့ကိုပေးလိုက်ပေးလိုက် သူဟာထမင်းကြော်တတ်သွားမှာဖြစ်တယ်</div>
            
		<div> Machine Learning အရပြန်ကြည့်မယ်ဆိုရင် စက်ကို Input + Output </div>
            
           <div> ဒီလို Pair လိုက်ပေးလိုက်တဲ့အခါမှာ Input ကနေ Output ထွက်စေတဲ့ </div>
            
           <div> Function ကိုသူ့ဘာသာသူခန့်မှန်းနိုင်သွားတယ် ဒါပါပဲ</div>
            
<div> ထမင်းက Input , ထမင်းကြော် က Output, ထမင်းကြော်နည်းက Function, </div>
            
           <div> ထမင်းကြော်နည်းမှန်အောင်စဉ်းစားပြီးတစ်ခါပြီးတစ်ခါလိုက်ကြော်ကြည့်နေတဲ့လုပ်ငန်းစဉ်က Machine Learning algorithms ပဲဖြစ်ပါတယ်</div>

 <div>ဒါကို Mathematics ရူထောင့်ကနေတစ်ချက်ရှင်းပြပါမယ် </div>
            
<div> Linear Algebra လို့ခေါ်တဲ့ Mathematics Chapter မှာ x (Input), y(Output),</div>
            
          <div>  ဥပမာ y=2x ဆိုရင် Function ဒါကို Mathematics ကိုသင်ဖူးသူတိုင်းနားလည်ကြပါလိမ့်မယ်</div>
            
<div>y သည် x အပေါ်မှာမူတည်ပါတယ် </div>
            
<div>Input သည် Output အပေါ်မှာမူတည်တယ်</div>
            
<div>ဘာအပေါ်မှာလိုက်ပြီးမူတည်မှာလဲဆိုတော့ Function အပေါ်မှာလိုက်ပြီး တွက်ချက်အဖြေထုတ်သွားတာပါ</div>
            
<div>ဒါက Traditional Programming ပါ</div>
            
<div>Machine Learning မှာကကြ စက်ကို</div>

<div>Input(x)------Output(y)</div>
            
<div>1 ------------ 2</div>
            
<div>2 ------------ 4</div>
           
<div>3 ------------ 6</div>
            
<div>4 ------------ 8</div>
            
<div>5 ------------ 10</div>

            
<div>ဒီလိုမျိုး Trillion ချီတဲ့အစုံလိုက်အစုံလိုက် Input ရယ် Output ရယ်ကိုပေးလိုက်တဲ့အခါမှာ </div>
            
<div>ဒီ Input တွေက ဒီ Output ထွက်ဖို့ကို တူညီတဲ့ Function တစ်ခုထွက်ဖို့ကို </div>
            
            <div>အကြိမ်ပေါင်းများစွာ တွက်ချက်စဉ်းစားပြီးတော့ နောက်ဆုံး Function  တစ်ခုကိုထုတ်နိုင်သွားပါတယ်</div>
            
<div>အဲလိုထုတ်နိုင်သွားအောင်လုပ်တာသည် Machine Learning ဖြစ်ပါတယ်</div>
            
<div>ဒါဆိုနောက်လာမယ့် မသိတဲ့ Input တွေအတွက် စက်ကိုယ်တိုင်စဉ်းစားတွက်ချက်ထားတဲ့</div>
            
           <div> Function ကိုအသုံးချပြီးတော့ Output တွေအများကြီးကိုလဲတွက်ချက်နိုင်သွားမှာဖြစ်ပါတယ် </div>
            
<div>ဒီကနေမှအခြေခံပြီးတော့ နောက်ဆုံး Artificial Intelligence ဆိုတာကို Train လုပ်နိုင်ခဲ့တာဖြစ်ပါတယ်</div>

<div>ဒါကိုလက်တွေ့ဘဝမှာဘယ်လိုအသုံးချနေလဲ</div>

<div>ဥပမာ ကင်ဆာဖြစ်ခဲ့တဲ့လူတေအများကြီးရဲ့ ကင်ဆာ ဓာတ်မှန် Photo တွေကို </div>
            
           <div> Input သွင်းလိုက်တယ် ပြီးတော့ တစ်ခုချင်းစီရဲ့ ကင်ဆာအခြေအနေဘယ်လိုရှိလဲ </div>
            
           <div> Danger Zone လား Safe Zone လားစသဖြင့် ရှိနေပြီးသား Result(Output) တွေကို စက်ကိုပေးလိုက်မယ်</div>
            
<div>စက်က Machine Learning Algorithm တွေကိုအသုံးပြုပြီးတော့ ဘယ်လို အခြေအနေဆို </div>
            
           <div> ဘာဖြစ်နိုင်လဲဆိုတာကို အရင်ကမရှိသေးတဲ့ နောက်လာမယ့် လူနာတွေအပေါ်မှာ </div>
            
           <div> အရင်ကရှိခဲ့ Data တွေနဲ့ အတွေ့အကြုံယူ တွက်ချက်စဉ်းစားပြီးတော့ </div>
            
           <div> ဒီလူက ကင်ဆာဖြစ်နိုင်မဖြစ်နိုင်ဆိုတာအဖြေထုတ်ပေးသွားမှာဖြစ်ပါတယ်</div>
            
<div>ဒါဆိုရက်သာမာန်လူသားတစ်ယောက်မလုပ်နိုင်တဲ့ကိစ္စကို စက်ကလုပ်နိုင်သွားတာဖြစ်ပါတယ် </div>

<div>So ဒီနေရာမှာလဲ Input တွေ Result တွေဆိုတာလဲ ရှိနှင့်နေပြီးသား Data တွေဖြစ်ပါတယ်</div>
            
<div>ဒါကြောင့်လဲ Machine Learning ဟာ Data Science အပေါ်မှာလဲ မှီခိုတယ်ဆိုတာနားလည်နိုင်ပါတယ်</div>

           
<div>ရှိနေပြီးသား Data တွေအပေါ်မှာ မူတည်ပြီး တွက်ချက်တဲ့အပိုင်းမှာလဲ </div>
            
            <div>Probability, Linear Algebra, Calculus စတဲ့ Mathematics Concept တွေကလဲ</div>
            
            <div>Machine Learning Algorithm တွေထဲမှာ ထည့်သွင်းအသုံးချတတ်ဖို့လိုပါသေးတယ်</div>
            
<div>ဒါဆိုရင် General အားဖြင့်တော့သဘောပေါက်လောက်ပြီလို့ထင်ပါတယ်</div>
     
            
            <div class='row'>
            	<div class='col'><a href='oscord_ai2.php'>Back</a> </div>
                <div class='col'><a href='oscord_ai4.php'>Next</a>  </div>
            </div>
      
 	</div>
        
        
   
</body>