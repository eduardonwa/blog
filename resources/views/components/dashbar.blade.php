<div class="dashbar" id="sideNav">
    <a href="/dashboard"><img class="dash-logo" src="/img/logo.png" alt="eduardocoello logo"/></a>
    <div class="dropup">
        <button class="postbtn" id="dropBtn"> <i class="fas fa-copy"></i> Posts</button>
        <div class="dropup-content">
          <a href="/dashboard/posts/">Index</a>
          <a href="/posts/create">Create</a>
        </div> <!-- dropup box -->
      </div> <!--dropup end --> 
    
    <a href="/dashboard/categories"> <button class="dash-btn hide"> <i class="fas fa-stream"></i> Categories </button> </a>
    <a href="/dashboard/tags"> <button class="dash-btn hide"> <i class="fas fa-hashtag"></i> Tags </button> </a>
    <a href="#"> <button class="dash-btn hide"> <i class="fas fa-envelope-open-text"></i> Email </button> </a>
    <a href="/"> <button class="dash-btn hide"> <i class="fas fa-home"></i> Homepage </button> </a>
    <a href="#"> <button class="dash-btn plusbtn" onclick="openNav()"> </button> </a>
    <!-- Desktop dashbar end -->
  
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="/dashboard">Dashboard</a>
        <a href="/dashboard/posts">Posts</a>
        <a href="/dashboard/categories">Categories</a>
        <a href="#">Email</a>
        <a href="/dashboard/tags">Tags</a>
        <a href="/">Homepage</a>
      </div> <!-- Mobile dashbar end -->
  
  </div> <!-- dashbar end -->
  
  <div class="switch" id="sideToggle">
    <i class="fas fa-sort toggle"></i>
  </div>
  
  <script>
  
    const dropUp = document.getElementById('dropBtn');
    dropUp.addEventListener("click", showDrop);
    function showDrop() 
    {
        let dropUpContent = document.querySelector('.dropup-content');
        dropUpContent.classList.toggle("show");
    }
  
    const toggleBar = document.getElementById('sideToggle');
    toggleBar.addEventListener("click", collapse);
    function collapse()
    {
        let collapseNav = document.querySelector('.dashboard-grid');
        collapseNav.style.gridTemplateColumns = "144px auto 1fr";
    }
  
    function openNav() {
        document.getElementById("mySidenav").style.width = "100%";
    }
  
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    </script>