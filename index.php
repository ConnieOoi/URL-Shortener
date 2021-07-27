<?php

    include "header.php";

?>

<body>
    <div class="wrapper">
        <form action="#">
            <input type="text" name="full-url" placeholder="Enter or Paste a long URL" required>
            <i class="url-icon uil uil-link"></i>
            <button>Shorten</button>
        </form>
        
        <?php
                $sql2 = mysqli_query($conn, "SELECT * FROM url ORDER BY id DESC");
                if(mysqli_num_rows($sql2) > 0){
        ?>
        
        <div class="count">
        
        <?php

            $sql3 = mysqli_query($conn, "SELECT COUNT(*) FROM url");
            $res = mysqli_fetch_assoc($sql3);

            $sql4 = mysqli_query($conn, "SELECT clicks FROM url");
            $total = 0;

            while($c = mysqli_fetch_assoc($sql4)){
                $total = $c['clicks'] + $total;
            }

        ?>

            <span>Total Links: <span><?php echo end($res); ?></span> & Total Clicks: <span><?php echo $total; ?></span></span>
            <a href="delete.php?delete=all">Clear All</a>
        </div>

        <div class="urls-area">
            <div class="title">
                <li>Shorten URL</li>
                <li>Original URL</li>
                <li>Clicks</li>
                <li>Action</li>
            </div>

            <?php
                while($row = mysqli_fetch_assoc($sql2)){
        ?>
        
            <div class="data">  
                <li>
                    <a href="http://localhost/URL Shortener/<?php echo $row['shorten_url']?>" target="_blank">

                    <?php 
                        echo 'localhost/URL Shortener/'.$row['shorten_url'];
                    ?>

                    </a>
                </li>
                <li>

                    <?php 
                        if(strlen($row['original_url']) > 65) {
                            echo substr($row['original_url'], 0, 65). '...';
                        } else {
                            echo $row['original_url'];
                        }
                    ?>

                </li>
                <li><?php echo $row['clicks']?></li>
                <li><a href="delete.php?id=<?php echo $row['shorten_url'] ?>">Delete</a></li>
            </div>
            
        <?php
                }   
            }
        ?>

        </div>
        
    </div>

    <div class="blur-effect"></div>
    <div class="popup-box">
        <div class="info-box">
            Your short link is ready. You can also edit your short link now but can't edit once you saved it.
        </div>
        <form action="#">
            <label>Edit your shorten URL</label>
            <input type="text" spellcheck="false" value="">
            <i class="copy-icon uil uil-copy-alt"></i>
            <button>Save</button>
        </form>
    </div>
    
    <script src="script.js"></script>

</body>
</html>