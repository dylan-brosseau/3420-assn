<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/assn.css" /> <!-- Including an external CSS file -->

    <title>Edit List Item</title> <!-- Setting the page title -->
</head>

<body class="edititem">
    
    <!-- User can edit list -->
    <main>
    <ul>
       <li>
            <a href="index.php">Back to Main List</a> <!-- Navigation link to the "Main List" -->
       </li> 

       <li>
            <a href="my_profile.php">My Profile</a> <!-- Navigation link to the "My Profile" -->
       </li> 
    </ul>
    
    <form method="POST" > <!-- Form for editing list item -->
        <div class="edititempage">
            <h1>Edit List Item</h1> <!-- Heading for the edit page -->
            <div>
                <input type="text" id="title" name="title" placeholder="Title" required> <!-- Input field for the title of the list item -->
            </div>
            
            <div>
                <textarea id="description" name="description"  placeholder="Description"  required></textarea> <!-- Textarea for describing the list item -->
            </div>
    
            <fieldset class="edititemset">
                <legend>Status</legend> <!-- Legend for the status field -->
                  
                <div>
                    <input type="radio" name="status" id="completed" value="c" required>
                    <label for="completed">Completed</label> <!-- Radio button for marking the item as completed -->
                  </div>
                  
                  <div>
                    <input type="radio" name="status" id="notcompleted" value="r" required>
                    <label for="notcompleted">Not Completed</label> <!-- Radio button for marking the item as not completed -->
                  </div>
                
            </fieldset>
            
            <fieldset class="edititemset">
                <div>
                    <label for="category">Category:</label> <!-- Label for the category selection -->
                    <select id="category" name="category"> <!-- Dropdown for selecting the category -->
                    <option value="travel">Travel</option>
                    <option value="adventure">Adventure</option>
                    <option value="career">Career</option>
                    <option value="personal">Personal</option>
                    <option value="other">Other</option>
                    </select>
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Rating</legend> <!-- Legend for the rating field -->
                <div>
                    <input type="range" id="rating" name="rating" min="1" max="5" value="3"> <!-- Slider for rating the item (1-5) -->
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Completion Date</legend> <!-- Legend for the completion date field -->
                <div>
                    <input type="date" id="completion-date" name="completion-date" value="" required> <!-- Input field for specifying the completion date -->
                </div>
            </fieldset>
          
            <div>
                <textarea id="file" name="file"  placeholder="Details"  required></textarea> <!-- Textarea for additional details about the item -->
            </div>
                
            <div>
                <input type="file" id="proof" name="proof" accept="image/*"  placeholder="Input Image"> <!-- File input for uploading proof images -->
            </div>
    
            <button type="submit">Save Changes</button> <!-- Submit button for saving changes to the list item -->

        </div>

       
        </form>
    </main>
    
</body>
</html>
