<header>
    <div id="Hd">
        <div class="hd-logo">
            <h1>
                <a href="{{ route('home') }}">
                    お酒の名刺
                </a>
            </h1>
        </div>
        <div class="hamburger-menu" style="position: absolute; right: 20px; top: 20px;">
                <button class="hamburger-btn">
                    &#9776;
                </button>

                <div id="profileMenu" class="profile-menu hidden">
                    <div class="hb-go-myprofile">
                        <a href="{{ route('account') }}">プロフィール</a>
                    </div>
                    <div class="hb-profile-edit">
                        <a href="{{ route('account.edit') }}">プロフィール編集</a>
                    </div>
                    <div class="hb-ID-search">
                        <a href="{{ route('account.search') }}">ID検索</a>
                    </div>
                    <div class="hb-ID-search">
                        <a href="{{ route('rakuten.search') }}">最近飲んだお酒の登録</a>
                    </div>
                    <div class="hb-go-followlist">
                        <a href="{{ route('followlist.index') }}">フォロー一覧</a>
                    </div>
                    <div class="hb-logout">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">ログアウト</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</header>
