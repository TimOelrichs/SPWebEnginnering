class SolutionsServive {

    apiUrl = "http://www2.inf.h-bonn-rhein-sieg.de/~toelri2s/backend/solutions/server.php";

    getAllData() {
        return await(await fetch(new Request(url), {
            method: 'GET',
            mode: 'cors',
            cache: 'no-store'
        })).json();
    }

    incView(id) {
        return await(await fetch(new Request(url), {
            method: 'GET',
            mode: 'cors',
            cache: 'no-store'
        })).json();
    }

    incLike(id){

    }

    decLikes(id) {
        
    }

}

const solutionsService = new SolutionsServive();
export default solutionsService;