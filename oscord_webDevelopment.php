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
    <title>oscord.what is wedDevelopment.com</title>
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
        
            .main p div{
                    margin-bottom : 15px;
                    line-height : 40px;
                    }

                    
            .main p div,h3,h4 {
                  line-height : 40px;
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
     <div class='container main' ><p>
    		<div><h3>How to start learning Web Development</h3></div>
             
            <div>Web Development ကိုလေ့လာတဲ့အခါမှာ Frontend & Backend ဆိုပြီးနှစ်ပိုင်းလေ့လာရပါတယ်</div>

			<div>Frontend ပိုင်းကတော့ Website တစ်ခုမှာ User Interface ဘက်ကနေမြင်နေရသမျှ </div>
             
             <div>Content အားလုံးကို Develop လုပ်ရတာဖြစ်ပါတယ် </div>
			
            <div> Web Development ကိုစတင်လေ့လာတော့မယ်ဆိုရင် Frontend ပိုင်းဖြစ်တဲ့ </div>
             
             <div>HTML ကနေစတင်ပြီး CSS, JavaScript, Bootstrap စတဲ့နည်းပညာတွေကိုလေ့လာဖို့လိုအပ်ပါတယ် </div>
             
			<div>Html( Hyper Text Markup Language) သည် Website ရဲ့ကျောရိုးကြီးတစ်ခုလုံးကိုထောက်ပံ့ပေးထားတာဖြစ်ပါတယ် </div>
             
            <div> Web တစ်ခုမှာမြင်ရသမျှ Content အားလုံးဟာ HTMl ကိုအသုံးပြုပြီးဖန်တီးထားတာဖြစ်ပါတယ်</div>

             
             <div>CSS(Cascading Style Sheet) ဆိုတာကတော့</div>
             
			<div>Html နဲ့ရေးသားထားတဲ့ Content တွေကို ပိုပြီးလှပအောင် Design ပိုင်းကိုထောက်ပံ့ပေးတာဖြစ်ပါတယ် </div>
             
             <div>Webpage တစ်ခုကို Responsive ဖြစ်အောင်လဲထောက်ပံ့ပေးပါတယ်</div>
             
			<div>JavaScript ကတော့ Function Control Flow တွေဖန်တီးဖို့အသုံးပြုပါတယ် </div>
             
            <div> ဥပမာအားဖြင့်ဆိုရရင် ဘယ် Button ကိုနှိပ်လိုက်လို့ ဘယ်အလုပ်တွေကိုအလုပ်လုပ်မလဲ</div>
             
             <div>ဆိုတာတွေကိုထိန်းချုပ်တာဖြစ်ပါတယ်</div>
             
			<div>Boostrap(Framework for CSS & JS) - Framework ရဲ့သဘောတရားသည် </div>
             
            <div> ရေးထားပီးသားဖန်တီးထားပီးသား Code တွေကိုအဆင်သင့်ယူသုံးလို့ရအောင် </div>
             
             <div>ဖန်တီးထားတာဖြစ်ပါတယ် </div>
             
            <div> Bootstrap Framework ကိုကြတော့ CSS & JS ရေးသားမယ့်နေရာမှာ </div>
             
            <div> ထောက်ပံ့နိုင်အောင်ဖန်တီးထားတာဖြစ်ပါတယ်</div>
	             
			<div>Jquery(Framework for JavaScript) - JavaScript ရဲ့ Framework တစ်ခုဖြစ်တဲ့အတွက် </div>
             
             <div>အချို့သော JavaScript control flow တွေကို ကိုယ်တိုင်ရေးစရာမလိုဘဲ အသင့်ယူသုံးနိုင်မှာဖြစ်ပါတယ်</div>
             
			<div>အပေါ်မှာပြောသွားတဲ့ Technique တွေသည် </div>
             
            <div> Frontend Development အတွက်မရှိမဖြစ်လိုအပ်တဲ့နည်းပညာတွေဖြစ်ပါတယ် </div>
             
            <div> ဒါ့အပြင် ReactJS စတဲ့နည်းပညာတွေကိုလဲ Frontend အတွက်ဆက်ပြီးလေ့လာသွားချင်ရင်လဲ ရပါတယ်</div>

             <br>
             <hr>
             
			<div><h3>Backend Development</h3> </div> <div> အပိုင်းကတော့ Server Page တစ်ခုကနေ </div>
             
             <div>Database နဲ့ Connect လုပ်တဲ့အပိုင်းဖြစ်ပါတယ်</div>
             
			<div>ဒီအပိုင်းမှာ Database နဲ့ပတ်သက်ပြီး အသေးစိတ်ပြောရန်လိုအပ်ပါတယ်</div>
             
			<div>Database ဆိုတာ အလွယ်တကူပြောရမယ်ဆိုရင် Data တွေကို Table တွေအလိုက်သိုလှောင်ထားတဲ့ Server တစ်ခုဖြစ်ပါတယ်</div>
             
			<div>Backend Developing အပိုင်းသည် လက်ရှိရေးနေတဲ့ Program ဘက်ကနေ Database တစ်ခုနဲ့ချိတ်ဆက်ပြီးတော့ </div>
             
             <div>Database ထဲမှာရှိနေတဲ့ Data တွေကို INSERTION, DELETION, UPDATING & SELECTION ဒီလေးခုကိုအဓိကလုပ်ဆောင်သွားမှာဖြစ်တယ် </div>
             
			<div>မြင်သာအောင်ပြောရမယ်ဆိုရင် Web page တစ်ခုမှာ Form ဖြည့်ရတဲ့အပိုင်းကိုမြင်ဖူးကြမှာပါ </div>
             
             <div>အဲဒီမှာ ကိုယ်ဖြည့်လိုက်တဲ့ Form ထဲက Data တွေသည် Database တစ်ခုထဲကိုရောက်မှသာလျှင် Permanent ဖြစ်မှာဖြစ်ပါတယ်</div>

             <div>လက်ရှိရေးနေတဲ့ Program ဘက်ကနေ Database Connection လုပ်တယ်လို့ပြောတဲ့နေရာမှာ </div>
             
           <div>  အဲဒီ Program သည် Backend Language Program တစ်ခုခုနဲ့ရေးထားတာပါ</div>
             
			<div>ဘာတွေရှိမလဲဆိုတော့</div>

		<div>- PHP + Laravel Framework</div>
                
		<div>- Python + DJango Framework</div>
                
		<div>- J2EE + Spring Framework</div>
                
		<div>- C# + Asp.net framework</div>

	<div>	စတဲ့ Technique တွေနဲ့ Backend Develop လုပ်လို့ရပါတယ် </div>
             
           <div>  အဲတော့ Web Developer တစ်ဦးက Frontend ပိုင်းကိုလေ့လာ့ပြီးပြီဆိုရင် </div>
             
			<div>Backend ပိုင်းအတွက် Language တစ်ခုခုကိုရွေးချယ်ရပါတယ် </div>
             
            <div> တစ်ခုကိုတတ်ရင်လဲကျန်တဲ့ Technique တွေကိုတတ်မြောက်ဖို့လွယ်ကူနိုင်ပါတယ်</div>
             
			<div>	အဲဒီမှာ Framework ဆိုပြီးတွဲဖော်ပြထားတာတွေသည် </div>
             
         <div>    Backend အတွက်သုံးရမယ့် Languages တွေကိုအကူအနေနဲ့ ထောက်ပံံ့ပေးတာတွေဖြစ်ပါတယ် </div>
             
		<div>	ဒီလောက်ဆိုရင် နည်းလည်လောက်ပီလို့ထင်ပါတယ် </div>
                </p>	
     </div>
        
</body>