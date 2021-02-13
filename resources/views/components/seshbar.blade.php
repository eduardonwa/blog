<div class="sesh-bar">
    @if(Route::has('login'))
        @auth
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); 
                    document.getElementById('form-logout').submit();"> 
                    <button class="sesh-btn"> 
                        Logout
                    </button> 
                </a>
                <a href="/dashboard"> <button class="sesh-btn hide"> Dashboard </button> </a>

                <a href="#"> <button class="dash-btn plusbtn" onclick="openNav()"> </button> </a>

                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a href="/dashboard">Dashboard</a>
                    <a href="/dashboard/create">+ Post</a>
                    <a href="/dashboard#category">+ Category</a>
                    <a href="/dashboard#about">Update About</a>
                  </div>

                    <form id="form-logout"
                        action="{{route('logout')}}"
                        method="POST"
                        style="display: none">
                            @csrf
                    </form>
            @else
            <a class="login-bar" href="/login"> Login </a>
        @endauth
    @endif
</div>

<script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "100%";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
</script>