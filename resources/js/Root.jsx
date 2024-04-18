import axios from "axios";
import { useEffect, useState } from "react";

export default () => {

    const [city, setCity] = useState("London");

    const handleClick = ( event ) => {
        axios.post("/api/receive/Birmingham").then(( response ) => {
            console.log(response.data);
        });
    };

    return (
        <div className="h-full w-full">
            <h1>Welcome</h1>
            <div >{ city }</div>
            <button onClick={ handleClick }>Button</button>
        </div>
    );
}