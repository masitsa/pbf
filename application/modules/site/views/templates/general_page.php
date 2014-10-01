<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->load->view('includes/header', '', TRUE); ?>
    </head>

	<body>
    	<!-- Modal Login -->
        <?php //echo $this->load->view('includes/modal_login', '', TRUE); ?>
        
    	<!-- Top Navigation -->
        <?php echo $this->load->view('includes/top_navigation', '', TRUE); ?>
        <?php echo $content;?>
        
        <?php echo $this->load->view('includes/footer', '', TRUE); ?>
</body>
</html>
