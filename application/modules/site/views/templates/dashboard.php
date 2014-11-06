<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->load->view('includes/header', '', TRUE); ?>
    </head>

	<body>
    	<!-- Top Navigation -->
        <?php echo $this->load->view('includes/top_navigation', '', TRUE); ?>
        <?php echo $content;?>
        
        <?php echo $this->load->view('includes/footer', '', TRUE); ?>
</body>
</html>
