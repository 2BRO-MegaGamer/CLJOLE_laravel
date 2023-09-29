import { React } from "react";

class Users extends React.Component {
    constructor(props){
        super(props);
        this.getallUsers = this.getallUsers.bind(this);
    }
    getallUsers(){
        console.log(this.props);
        this.props.fetchUsers();
    }
    render(){
        return(
            <div>
                hello
            </div>
        )
    }
}