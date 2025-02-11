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
            
     		<div><h4> Deep Learning ဆိုတာဘာလဲ AI နဲ့ဘယ်လိုဆက်စပ်နေတာလဲ</h4> </div>

			<div>တကယ်တော့ AI ရဲ့အစဟာ Deep Learning ကနေစခဲ့တာဖြစ်ပါတယ် </div>
			
            <div>သမိုင်းကိုပြန်ကြည့်ရမယ်ဆိုရင် World War II ဖြစ်ပေါ်နေတုန်းကပေါ့ </div>
            
            <div>Computer Scientist လည်းဖြစ် Psychologist လည်းဖြစ်တဲ့လူတစ်ဦးက </div>
            
           <div> Deep Learning ကိုရှာတွေ့ခဲ့တာဖြစ်တယ်</div>

			<div>ဒါကိုနားလည်ဖိုဆိုရင် Psychology ဗဟုသုတတစ်ချိုကိုသိထားဖိုလိုအပ်ပါတယ်</div>

			<div>လူသားတွေဟာ မွေးလာကာစချင်းချင်းမှာ </div>
            
            <div>အရွယ်ရောက်ပီးသား လူသားတစ်ယောက်ရဲ့ အသိဉာဏ် </div>
            
           <div> စဉ်းစားတွေးခေါ်နိုင်စွမ်းမရှိသေးပါဖူး</div>

		<div>အဲဒီအတွက် သူရဲ့ကြီးပြင်းလာစဉ်ကာလအတွင်းမှာ အသိဉာဏ်ရှိလူသားတစ်ယောက်ဖြစ်ဖို </div>
            
           <div> အရင်ဆုံးလုပ်ရတာက သူ့ပတ်ဝန်းကျင်မှာ ရှိနေတဲ့ Data တွေကို Absorb လုပ်ရတာပါပဲ</div>
            
		<div>Absorb လုပ်နိုင်ဖို မိဘတွေ ဆရာတွေက ကလေးတစ်ယောက်ကို Train(လေ့ကျင့်) ပေးရပါတယ်. </div>
            
           <div> အဖေဆိုတဲ့လူကြီးကိုပြပြီးတော့ ဒါကအဖေ, အမေဆိုတဲ့လူကြီးကိုပြပြီးတော့ဒါကအမေ, </div>
            
           <div> နေထိုင်နေတဲ့အဆောက်အဦးကြီးကိုပြပြီးတော့ ဒါကတော့အိမ်, </div>
            
           <div> စသဖြင့် ကလေးကို များပြားလှတဲ့ Data တွေ Absord  လုပ်နိုင်အောင်ရိုက်သွင်းပေးရပါတယ်</div>
            
			<div>Data တွေကိုသိပြီးသွားတဲ့ကလေးတစ်ယောက်ဟာ ဥပမာ အမေကိုအမေလိုသိသွားတယ် </div>
            
            <div>အဖေကိုအဖေလိုသိသွားတယ် အိမ်ကိုအိမ်လိိသိသွားတယ် </div>
            
            <div>ဘာလိုအဲလိုသိတာလဲဆိုတော့ အမေကိုမြင်တယ်ပဲထားပါတော့ </div>
            
           <div> အမေရဲ့ပုံရိပ်ကိုမြင်ရင် အရင်ဆုံး မျက်လုံးကမြင်ပါတယ် </div>
            
            <div>မြင်လာတဲ့ပုံရိပ်ကို ဦးနှောက်ကဖတ်တယ် ဦးနှောက်ထဲမှာရှိတဲ့ Signal တွေကတစ်ခုနဲ့တစ်ခုနဲ့ချိတ်ဆက်ပြီး </div>
            
           <div> ကိုယ် absord လုပ်ထားတဲ့ Data တွေနဲ့တိုက်စစ်တယ် </div>
            
            <div>ပြီးရင် သေချာတယ်ဆိုရင် ဒါဟာ အမေဆိုတာကို သိသွားပါတယ်</div>
            
           <div> (ဒါကတော့ မြင် ကြား အနံ့ အရသာ အထိအတွေ့ အာရုံငါးပါးထဲက </div>
            
           <div> အမြင်အာရုံအရ Data Absord လုပ်တာကိုပဲဥပမာပေးတာဖြစိပါတယ် </div>
            
           <div> လူသားတစ်ယောက်အတွက်ဆိုရင် အာရုံငါးပါးလုံးကနေ </div>
            
            <div>Sense ဖြစ်တာတွေအကုန်လုံးသည် Data တွေဖြစ်ပါတယ်)</div>
            
			<div>နောက်ပိုင်းကြ ရရှိတဲ့ Data တွေများလာတဲ့အခါမှာ </div>
            
            <div>လူလိုပြောရင်တော့ ပညာစုံလာတဲ့အခါမှာ</div>
            
            <div>ကိုယ်ပိုင်စဉ်းစားဆုံးဖြတ်နိုင်တဲ့ အသိဉာဏ်တွေရလာတယ်</div>

 			<div>Deep Learning ဆိုတာလဲဒီသဘောတရားပါပဲ</div>
            
			<div> စက်တစ်ခုကို အသိဉာဏ်တစ်ခုပေးဖိုဆိုရင်အရင်ဆုံးသူ့ကို Data တွေအများကြီး Absord လုပ်ခိုင်းရပါတယ်</div>
            
            <div>(ဒီနေရာမှာ Data Science ကအရေးပါလာတာဖြစ်ပါတယ် </div>
            
            <div>Handle လုပ်ပြီး Clean လုပ်ပြီး Analysis လုပ်ပြီးတဲ့ </div>
            
            <div>Data တွေကိုယူပြီးစက်ကိုပြန်လည် Train ပေးရမှာဖြစ်ပါတယ်)</div>
            
			<div>ဥပမာ စက်က ခွေးကိုခွေးလိုသိစေချင်တယ်ဆိုရင် </div>
            
            <div>အရင်ဆုံး သူ့ကိုခွေးပုံတွေအများကြီးကို ပြရပါတယ် </div>
            
			 <div>ဒီနေရာမှာ ပုံ Image ဆိုတာသည် Pixel အစုလိုက်လေးတွေနဲ့အလုပ်လုပ်တာဖြစ်တဲ့အတွက်</div>
            
           <div> ဒီ Pixel အစုလိုက်လေးတွေဆို ခွေး အခြားမတူတဲ့ ခွေးပုံက Pixel အစုလေးတွေကိုလဲခွေး</div>
            
            <div>ဒီလိုနဲ့ Trillion နဲ့ချီတဲ့ ခွေးပုံတွေကို စက်ကို Absord လုပ်ခိုင်းလိုအပြီးမှာ သူသည် ခွေးကိုခွေးမှန်းသိသွားတယ် </div>
            
           <div> Trillion ထဲမှာမပါတဲ့ အခြားခွေးပုံတစ်ခုကိုပြသတဲ့အခါမှာလဲ သူ့ဘာသူ Probability တွက်ချက်ပြီးတော့</div>
            
            <div>ခွေးကိုခွေးမှန်းဆုံးဖြတ်နိုင်သွားမှာဖြစ်ပါတယ်</div>
           
		<div> ဒီလိုဆုံးဖြတ်တဲ့နေရာမှာလဲ Deep Learning မှာ လူဦးနှောက်ထဲကလို Signal </div>
            
         <div>    ဒီမှာတော့ Neuron Link တွေချိတ်ဆက်ပြီးတော့အလုပ်လုပ်ကြပါတယ် </div>
		
           <div>  Neuron Link တွေမှာဆိုရင် Layer1 LayerN အထိပုံမှာပြထားတဲ့အတိုင်းလေးတွေ အလုပ်လုပ်ကြပါတယ်</div>
            
<div> ဒါရဲ့အသေးစိတ်အလုပ်လုပ်ပုံကိုတော့ သေသေချာချာ Course တစ်ခုအနေနဲ့လေ့လာမှနားလည်နိုင်မှာဖြစ်ပါတယ်</div>
            
<div> ဒါဆိုရင် Deep Learning နဲ့ပတ်သက်ပြီးကတော့ ဒီနေရာမှာ လုံလောက်ပြီလိုထင်ပါတယ်</div>
            
<div> Machine Learning နဲ့ရောဘာကွာလဲ Machine Learning  ကရော ဘာကြီးလဲဆိုတာ ဆက်လက်ဖတ်ရူပေးပါအုန်း ...</div>
            
            <div class='row'>
            	<div class='col'><a href='oscord_ai1.php'>Back</a> </div>
                <div class='col'><a href='oscord_ai3.php'>Next</a>  </div>
            </div>
      
 	</div>
        
        
   
</body>