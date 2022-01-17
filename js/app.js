// async fetch functions
// CREATE:  method=POST
// READ:    method=GET
// UPDATE:  method=PUT
// DELETE:  method=DELETE 

async function fetchAPI_GET(apiURL) {
    try {
        let res = await fetch(apiURL, { method: 'GET'});
        return await res.json();
    } catch (error) {

        console.log("No result" + error);
    }
}

async function fetchAPI_DELETE(apiURL, id) {
    try {
        let res = await fetch(apiURL, 
                                {
                                    method: 'DELETE', 
                                    body: JSON.stringify({"id": id})
                                });
        return await res.json();
    } catch (error) {
        console.log("No results: " + error);
    }
}

async function fetchAPI_CREATE(apiURL, title, author, body, category_id) {
    try {
        let res = await fetch(apiURL, 
                                {
                                    method: 'POST', 
                                    body: JSON.stringify({
                                                            "title": title,
                                                            "author": author,
                                                            "body": body,
                                                            "category_id": category_id
                                                        })
                                });
        return await res.json();
    } catch (error) {
        console.log("No results: " + error);
    }
}


// async Render functions
// render post delete => plain text
async function DeletePost(id) {
    let url = `./api/posts/delete.php`;
    let post = await fetchAPI_DELETE(url, id);
    let html = `${post.message}`;
    let container = document.querySelector('.container');
    container.innerHTML = html;
}

// render post create => plain text
async function CreatePost(title, author, body, category_id) {
    let url = `./api/posts/create.php`;
    let post = await fetchAPI_CREATE(url, title, author, body, category_id);
    let html = `${post.message}`;
    let container = document.querySelector('.container');
    container.innerHTML = html;
    document.getElementById('title').value="";
    document.getElementById('author').value="";
    document.getElementById('body').value="";
    document.getElementById('category_id').value="";
}

// render post single read => <table>
async function ReadSinglePost() {
    let id = document.getElementById("id").value;
    let url = `./api/posts/read_single.php?id=${id}`
    let post = await fetchAPI_GET(url);
    let html = '';
    try {
        typeof post.id;
        html = 
            `<table>
                <tr>
                    <th width=2%>pid</th>
                    <th width=20%>Title</th>
                    <th width=10%>Author</th>
                    <th width=2%>cid</th>
                    <th width=8%>cname</th>
                    <th width=35%>Body</th>
                    <th width=15%>Created_at</th>
                    <th width=4%>Delete</th>
                    <th width=4%>Edit</th>
                </tr>
                <tr valign=top>
                    <td>${post.id}</td>
                    <td>${post.title}</td>
                    <td>${post.author}</td>
                    <td>${post.category_id}</td>
                    <td>${post.category_name}</td>
                    <td>${post.body}</td>
                    <td>${post.created_at}</td>
                    <td><button onclick="DeletePost(${post.id})">D</button></td>
                    <td><button onclick="UpdatePost(${post.id})">E</button></td>
                </tr>
            </table>`;
    } catch (error) {
        html = '<p>Er is geen record met dit nr</p>';
    }

    let container = document.querySelector('.container');
    container.innerHTML = html;
}


// render post read all => <table>
async function ReadPosts() {
    let url = './api/posts/read.php'
    let posts = await fetchAPI_GET(url);
    let html = '';
    html = '<table>';
    html += `<tr>
                <th width=2%>pid</th>
                <th width=20%>Title</th>
                <th width=10%>Author</th>
                <th width=2%>cid</th>
                <th width=8%>cname</th>
                <th width=35%>Body</th>
                <th width=15%>Created_at</th>
                <th width=4%>Delete</th>
                <th width=4%>Edit</th>
            </tr>`;
    posts.data.forEach(post => {
        let htmlSegment = `<tr valign=top>
                            <td>${post.id}</td>
                            <td>${post.title}</td>
                            <td>${post.author}</td>
                            <td>${post.category_id}</td>
                            <td>${post.category_name}</td>
                            <td>${post.body}</td>
                            <td>${post.created_at}</td>
                            <td><button onclick="DeletePost(${post.id})">D</button></td>
                            <td><button onclick="UpdatePost(${post.id})">E</button></td>
                           </tr>`;
        html += htmlSegment;
    })
    html += '</table>';
    let container = document.querySelector('.container');
    container.innerHTML = html;
}

// render categories list => <selectt>
async function ListCategories() {
    let url = './api/categories/read.php'
    let posts = await fetchAPI_GET(url);
    let html = '';
    html = '<select id="category_id" name="category_id" size="10">';
    posts.data.forEach(post => {
        let htmlSegment = `<option value="${post.id}">
                                ${post.name}
                            </option>`;
        html += htmlSegment;
    })
    html += '</select>';
    let categoriesselect = document.querySelector('.categoriesselect');
    categoriesselect.innerHTML = html;
}

