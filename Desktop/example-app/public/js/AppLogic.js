import { getDatabase } from "firebase/database";
import { initializeApp } from 'firebase/app';

// TODO: Replace with your app's Firebase project configuration
const firebaseConfig = {
    apiKey: "AIzaSyB3sWFcQ7QDMRvPPjqnUj9AsFTLTXN1n_o",
    authDomain: "riarafoodapp.firebaseapp.com",
    // The value of `databaseURL` depends on the location of the database
    databaseURL: "https://riarafoodapp-default-rtdb.firebaseio.com/",
    projectId: "riarafoodapp",
    storageBucket: "riarafoodapp.appspot.com",
    messagingSenderId: "SENDER_ID",
    appId: "1:1009996849406:android:f2e76789faf72de6c8c5af",
    // For Firebase JavaScript SDK v7.20.0 and later, `measurementId` is an optional field
    measurementId: "G-MEASUREMENT_ID",
};

const app = initializeApp(firebaseConfig);

// Get a reference to the database service
const database = getDatabase(app);

const starCountRef = database.ref('orders');
starCountRef.on('value', (snapshot) => {
    const data = snapshot.val();
    alert(data);
})


