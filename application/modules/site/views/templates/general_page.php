<!DOCTYPE html>
<html lang="en">
    <head>
<<<<<<< HEAD
        <?php echo $this->load->view('includes/header', '', TRUE); ?>
    </head>

	<body>
    	<!-- Modal Login -->
        <?php //echo $this->load->view('includes/modal_login', '', TRUE); ?>
        
    	<!-- Top Navigation -->
        <?php echo $this->load->view('includes/top_navigation', '', TRUE); ?>
        <?php echo $content;?>
        
        <?php echo $this->load->view('includes/footer', '', TRUE); ?>
=======
        <?php echo $this->load->view('site/includes/header', '', TRUE); ?>
    </head>

	<body>
    	<!-- Top Navigation -->
        <?php echo $this->load->view('site/includes/top_navigation', '', TRUE); ?>
        
        <?php echo $content;?>
        
        <?php echo $this->load->view('site/includes/footer', '', TRUE); ?>
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
</body>
</html>
