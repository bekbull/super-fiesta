<?php foreach($apps as $app): ?>      
    <div class="application">
        <p>Age: <?= $app?></p>
        <p>Phone: <?= $app['phone']?></p>
        <p>Email: bekbolbolatov@gmail.com</p>
        <p>Bio: <?= nl2br($app['bio'])?></p>
        <a href="./delete-application.php?username=<?= $app['username']?>">
            <button 
                style="
                background-color: #ff4136;
                border: 1px solid #ff4136;
                color: white;
            ">
            Delete
            </button>
        </a>
    </div>
<?php endforeach; ?>