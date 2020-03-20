        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	  	<script src="lib/js/config.js"></script>
        <script src="lib/js/util.js"></script>
        <script src="lib/js/jquery.emojiarea.js"></script>
        <script src="lib/js/emoji-picker.js"></script>
		<script>
		$(function() {
		// Initializes and creates emoji set from sprite sheet
		window.emojiPicker = new EmojiPicker({
		emojiable_selector: "[data-emojiable=true]",
		assetsPath: "lib/img",
		popupButtonClasses: "fa fa-smile-o"
		});
		// Finds all elements with emojiable_selector and converts them to rich emoji input fields
		// You may want to delay this step if you have dynamically created input fields that appear later in the loading process
		// It can be called as many times as necessary; previously converted input fields will not be converted again
		window.emojiPicker.discover();
		});
		</script>
    </body>
</html>