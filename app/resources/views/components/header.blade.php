<header>
    <div id="Hd">
        <div class="hd-logo">
            <h1>
                <a href="{{ route('home') }}">
                    お酒の名刺
                </a>
            </h1>
        </div>
        <div class="hamburger-menu" style="position: absolute; right: 20px; top: 20px;"> <!-- 右上に配置 -->
                <!-- HTML -->
                <button class="hamburger-btn">
                    &#9776;
                </button>

                <div id="profileMenu" class="profile-menu hidden">
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
                </div>
        </div>
    </div>
</header>
<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
