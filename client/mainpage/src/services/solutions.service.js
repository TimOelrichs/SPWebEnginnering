class SolutionsServive {

    url = "http://www2.inf.h-bonn-rhein-sieg.de/~toelri2s/backend/solutions/server.php";
    
    constructor() {
        this.url = "http://www2.inf.h-bonn-rhein-sieg.de/~toelri2s/backend/api/solutions/server.php";
    }

    async getAllData() {

        return await(await fetch(new Request(this.url), {
            method: 'GET',
            mode: 'cors',
            cache: 'no-store'
        })).json();
  
   }

    async incView(id) {
        return await(await fetch(this.url, {
            method: 'POST',
            mode: 'cors',
            cache: 'no-store',
            body: JSON.stringify({ action: "incView", id: id }),
            headers: JSON.stringify({'Content-Type': 'application/json'})
        }));
    }

    async incLike(id){
        return await(await fetch(new Request(this.url), {
            method: 'GET',
            mode: 'cors',
            cache: 'no-store',
            body: JSON.stringify({ action: "incLike", id }),
            headers:{"Content-Type:": "application/json"}
        })).json();
    }

    async decLikes(id) {
        return await(await fetch(new Request(this.url), {
            method: 'GET',
            mode: 'cors',
            cache: 'no-store',
            body: JSON.stringify({ action: "decLike", id }),
            headers:{"Content-Type:": "application/json"}
        })).json();
    }

    async postComment(commentObj) {
        return await(await fetch(new Request(this.url), {
            method: 'GET',
            mode: 'cors',
            cache: 'no-store',
            body: JSON.stringify({ action: "decLike", id: commentObj.id, comment: commentObj.comment }),
            headers:{"Content-Type:": "application/json"}
        })).json();
    }

}

const solutionsService = new SolutionsServive();
export default solutionsService;