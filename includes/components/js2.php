<script>
  
openMenu.addEventListener('click', () => {

	
	menu.style.display = "flex"

	menu.style.right = (menu.offsetWidth * -1) + 'px'

	
	setTimeout(()=> {
	
		menu.style.opacity = '1'

	
		menu.style.right = "0"

		openMenu.style.display = 'none'
	}, 10);
})
</script>
<script>

closeMenu.addEventListener('click', () => {

	
	menu.style.opacity = '0'

	
	menu.style.right = (menu.offsetWidth * -1) + 'px'

	
	setTimeout(()=> {
		menu.removeAttribute('style')
		openMenu.removeAttribute('style')
	}, 200);
})



</script>

<script>
    document.getElementById('openMenu').addEventListener('click', function () {
        document.getElementById('menu').classList.add('active');
    });

    document.getElementById('closeMenu').addEventListener('click', function () {
        document.getElementById('menu').classList.remove('active');
    });
</script>
