<h1>Booo! Exception Detected!</h1>
<h3><?php echo e($e->getMessage()); ?></h3>
<?php foreach($e->getTrace() as $index=>$trace): ?>
	<?php if(isset($trace['file'])): ?>
		<?php echo e($index); ?># <?php echo e($trace['file']); ?> at line <?php echo e($trace['line']); ?> <br/>
	<?php endif; ?>
<?php endforeach; ?>