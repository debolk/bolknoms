<div class="flash_messages">
    <?php foreach ($messages as $message): ?>
        <div class="notification <?php echo $message['type']; ?>">
            <?php echo $message['message']; ?>
        </div>
    <?php endforeach; ?>
</div>