<?php if (!empty($errors)): ?>
    <div style="background-color: var(--red-soft); color: var(--red); padding: 12px; border-radius: var(--radius-sm); margin-bottom: 16px; border: 1px solid var(--red); font-size: 13px;">
        <ul style="margin: 0; padding-left: 20px;">
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
