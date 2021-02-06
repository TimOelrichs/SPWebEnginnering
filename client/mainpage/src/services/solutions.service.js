class SolutionsServive {

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
        return await(await fetch(new Request(this.url), {
            method: 'POST',
            mode: 'cors',
            cache: 'no-store',
            body: JSON.stringify({ action: "incView", id: id })
        }));
    }

    async incLike(id){
        return await(await fetch(new Request(this.url), {
            method: 'POST',
            mode: 'cors',
            cache: 'no-store',
            body: JSON.stringify({ action: "incLike", id: id })
        }));
    }

    async decLikes(id) {
        return await(await fetch(new Request(this.url), {
            method: 'POST',
            mode: 'cors',
            cache: 'no-store',
            body: JSON.stringify({ action: "decView", id: id })
        }));
    }

    async postComment(commentObj) {
        return await (await fetch(new Request(this.url), {
            method: 'POST',
            mode: 'cors',
            cache: 'no-store',
            body: JSON.stringify({ action: "postComment", id: commentObj.id, comment: commentObj.comment }),
        }));
    }

}

const solutionsService = new SolutionsServive();
export default solutionsService;