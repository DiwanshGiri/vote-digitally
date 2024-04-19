<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:../');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Digitally</title>
    <link rel="stylesheet" href="home.css">
    <link rel="website icon" type="png" href="logo.png">
   
    
</head>
<body>
    <nav class="navbar background h-nav-resp">
        <ul class="nav-list v-class-resp">
            <div class="logo"><a href="home.php"><img src="img/logo.png" alt="logo"></a></div>
            <li><a href="home.php">Home</a></li>
            <li><a href="dashboard.php">Cast Vote</a></li>
            <li><a href="vote_results.php">Result</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <div class="rightnav v-class-resp">
        </div>
        <div class="burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
       
    </nav>
    <section class="background firstSection" id="home">
        <div class="box-main">
            <div class="firstHalf">
                <p class="text-big">Online Voting System</p>
                <p class="text-small">Let your vote speak for you. <br>Only a voter can change the power dynamics. <br>Your vote is your power. <br>Choose wisely, vote smartly.
                </p>
                <div class="button">
                    <button class="btn">
                        <a href="dashboard.php">Vote Now</a>
                    </button>
                </div>
            </div>
         
            <div class="secondHalf">
                <img src="img/logo.png" alt="logo">
            </div>
        </div>
    </section>
   
    <section class="section">
        <div class="paras">
        <p class="sectionTag text-big">How the existing voting system works</p>
        <p class="sectionSubTag text-small">Existing system is a manual one in which users and the details of the candidates are stored in books. The users have to wait a long time in queues for voting. Wrong and unwanted votes are given. Counting of votes are done manually which takes lots of time and inaccurate counting is done. It is very difficult to maintain historical data.
            In the existing system, there is compulsory need in physical presence in the time of election polling or vote counting.</p>
        </div>
        <div class="thumbnail">
            <img src="img/hero-image.webp" alt="ballot" class="imgFluid">
        </div>
    </section>
   
    <section class="section section-left" id="about">
        <div class="paras">
        <p class="sectionTag text-big">PROPOSE OF ONLINE VOTING SYSTEM</p>
        <p class="sectionSubTag text-small">The Online Voting System is a software application which avoids more manual hours that need to spend in record keeping and calculating votes. Through this the users and the candidates are registered online. Their information is stored in the database the admin can easily access the details of the voters and the candidates.            The voters are allowed to vote online they can even vote by sitting at home. Every User allowed to vote only once so there is no chance of duplicated votes. This application keeps the data in a centralized way which is available to all the users simultaneously. It is very easy to manage historical data in database. They can easily use the tool that decreases manual hours spending for normal things and hence increases the performance.</p>
        </div>
        <div class="thumbnail">
            <img src="img/parker-johnson-v0OWc_skg0g-unsplash.jpg" alt="ballot" class="imgFluid">
        </div>
    </section>
   
   
    <section class="section">
        <div class="paras">
        <p class="sectionTag text-big">ADVANTAGES OF PROPOSED SYSTEM</p>
        <p class="sectionSubTag text-small">The objective of the VOTING SOFTWARE is to provide better information for the users of this system easily they can vote from anywhere without facing any difficulty. The proposed system does not require any physical presence during vote polling or counting. So it is very easy to conduct elections even during the pandemic situations without any spread of disease or human live losses.
            The proposed system has good authentication so only authorized person can able to vote and also cannot vote multiple types. Vote Counting can be made very quickly and results will be displayed in few minutes.</p>
        </div>
        <div class="thumbnail">
            <img src="img/vottingimage.jpg" alt="ballot" class="imgFluid">
        </div>
    </section>
    <footer class="background">
        <p class="text-footer">
        Copyright &copy; 2027 - www.VoteDigitally.com - ALl rights reserved
        </p>
    </footer>
    <script src="resp.js"></script>
</body>
</html>
