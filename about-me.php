<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'meta.php'; ?>
  <title>D3gen.net - Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #ec72a7;
      --secondary-color: #ed8589;
      --accent-color: #9B30FF;
      --card-bg: rgba(30, 30, 30, 0.85);
      --border-color: rgba(236, 114, 167, 0.4);
      --popup-bg: #9e4145;
    }
    
    /* Global & Reset Styles */
    * {
      box-sizing: border-box;
    }
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Roboto', Arial, sans-serif;
      background: linear-gradient(135deg, #1e1e1e, #262626);
      overflow: hidden;
      position: relative;
      color: var(--primary-color);
    }
    
    /* Animations */
    @keyframes fadeShadow {
      0% { box-shadow: 0 0px 18px rgba(236, 114, 167, 0.8); }
      50% { box-shadow: 0 0px 25px rgba(236, 114, 167, 1); }
      100% { box-shadow: 0 0px 18px rgba(236, 114, 167, 0.8); }
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    /* Floating animations for the weeed */
    @keyframes floatLeft {
      0% { transform: rotate(-40deg) translateY(0); }
      50% { transform: rotate(-40deg) translateY(-5px); }
      100% { transform: rotate(-40deg) translateY(0); }
    }
    
    @keyframes floatRight {
      0% { transform: rotate(40deg) translateY(0); }
      50% { transform: rotate(40deg) translateY(-5px); }
      100% { transform: rotate(40deg) translateY(0); }
    }
    
    /* Layout */
    .center-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      padding: 20px;
    }
    
    .profile-card {
      background: var(--card-bg);
      width: 650px;
      max-width: 100%;
      border-radius: 10px;
      box-shadow: 0 0px 18px rgba(236, 114, 167, 0.9);
      text-align: center;
      position: relative;
      z-index: 1;
      overflow: hidden;
      animation: fadeIn 0.8s ease-out;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: 1px solid var(--border-color);
    }
    
    .profile-card:hover {
      transform: scale(1.02);
      box-shadow: 0 0px 25px rgba(236, 114, 167, 1);
    }
    
    .profile-card:hover ~ .leaf {
  filter: blur(100px);
}

    
    /* Profile Banner with Gradient Overlay */
    .profile-banner {
      width: 100%;
      height: 200px;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7)),
                  url('https://cdn.glitch.global/ed3a4764-468d-442b-9868-f7b2d0f3ba99/meaty.png?v=1729598850233') center/cover no-repeat;
    }
    
    /* Profile Picture */
    .profile-card img.profile-pic {
      width: 170px;
      height: 170px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #262626;
      margin-top: -85px;
      box-shadow: 0 0px 18px rgba(236, 114, 167, 1);
      animation: fadeShadow 2s infinite;
      background-color: #fff;
    }
    
    /* Text Styling */
    .profile-card h2 {
      margin: 15px 0 5px;
      font-size: 28px;
      color: var(--secondary-color);
    }
    
    .profile-card p {
      margin: 0;
      padding: 0 10px;
      font-size: 16px;
      color: var(--primary-color);
    }
    
    .profile-description {
      margin: 15px 0 20px;
      padding: 0 20px;
      font-size: 15px;
      line-height: 1.5;
      color: var(--primary-color);
    }
    
    /* Social Icons */
    .social-icons {
      margin-bottom: 20px;
    }
    
    .social-icons a {
      display: inline-block;
      color: var(--primary-color);
      font-size: 20px;
      margin: 0 10px;
      text-decoration: none;
      transition: color 0.3s, transform 0.3s;
    }
    
    .social-icons a:hover {
      color: var(--accent-color);
      transform: translateY(-3px);
    }
    
    /* Menu Button */
    .profile-card .menu {
      width: 30px;
      height: 30px;
      background-color: rgba(236, 114, 167, 0.7);
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.3s;
      position: absolute;
      top: 15px;
      right: 15px;
    }
    
    .profile-card .menu:hover {
      background-color: rgba(236, 114, 167, 1);
      transform: rotate(90deg);
    }
    
    /* Popup Menu */
    .popup-menu {
      display: none;
      position: absolute;
      top: 55px;
      right: 15px;
      background-color: var(--popup-bg);
      border: 1px solid #bb86fc;
      border-radius: 5px;
      padding: 10px;
      box-shadow: 0 0px 18px rgba(236, 114, 167, 1);
      z-index: 2;
      animation: fadeIn 0.3s ease;
      backdrop-filter: blur(5px);
    }
    
    .popup-menu a {
      display: block;
      color: #be78ff;
      margin: 5px 0;
      text-decoration: none;
      transition: color 0.3s, background-color 0.3s;
      padding: 5px;
      border-radius: 3px;
    }
    
    .popup-menu a:hover {
      color: #c98fff;
      background-color: rgba(236, 114, 167, 0.2);
    }
    
    /* Original Positioning with Floating Animation */
    .leaf {
      position: absolute;
      bottom: 0px;
      z-index: 2;
    }
    .leaf.left {
      right: 12%;
      transform: rotate(-40deg);
      animation: floatLeft 4s ease-in-out infinite;
    }
    .leaf.right {
      right: 69.5%;
      transform: rotate(40deg);
      animation: floatRight 4s ease-in-out infinite;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .profile-card {
        width: 90%;
      }
      .profile-banner {
        height: 150px;
      }
      .profile-card img.profile-pic {
        width: 140px;
        height: 140px;
        margin-top: -70px;
      }
      .profile-card h2 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>
  <img src="public/images/WEED-MARIJUANA.svg" class="leaf left">
  <img src="public/images/WEED-MARIJUANA.svg" class="leaf right">
  
  <div class="center-wrapper">
    <div class="profile-card">
      <div class="profile-banner"></div>
  
      <img src="https://d3gen.net/public/images/gif.gif" class="profile-pic" alt="Super sigma hoe">
      <h2>Degen/Gort</h2>
      <p>Owner | Dev</p>
  
      <div class="profile-description">
        <p>Hi, I'm the creator of Cerebral Incubation, dev of d3gen.net. I mainly make websites/services as a hobby or simple tools to automate things. My Discord username is d3ege3n—feel free to add/DM me!</p>
      </div>
      
      <div class="social-icons">
        <a href="https://discord.d3gen.net/"><i class="fa fa-discord"></i> Discord</a>
      </div>
  
      <button class="menu" onclick="toggleMenu()"></button>
  
      <div class="popup-menu" id="popupMenu">
        <a href="/pop">Emotion</a>
        <a href="/proj">My Projects</a>
        <a href="#">Link 3</a>
      </div>
    </div>
  </div>
  
  <script>
    function toggleMenu() {
      const menu = document.getElementById('popupMenu');
      menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }
  
    window.onclick = function(event) {
      if (!event.target.matches('.menu') && !event.target.closest('.popup-menu')) {
        const menu = document.getElementById('popupMenu');
        if (menu.style.display === 'block') {
          menu.style.display = 'none';
        }
      }
    }
  </script>
</body>
</html>
