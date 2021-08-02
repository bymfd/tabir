import React, { Component } from "react";
import { Image, StyleSheet, Text, TextInput, TouchableOpacity, View } from "react-native";
import { ExampleState, loadauthkey, storeauthkey } from "../../shared/APIKit";

const { beareer } = ExampleState.state;
const initialState = {
  username: "mfd2@mfd.com",
  password: "123456e",
  errors: {},
  authtoken: "",
  isAuthorized: false,
  isLoading: false,
};
const yule =async ()=>{
  let a=await loadauthkey();
  let b=JSON.parse(a);

  console.log(b.beareer);
}
export default class Login extends Component {
  state = initialState;


  constructor(props) {
 yule();
    super(props);

  }


  onClickListener = async (viewId) => {

    const { username, password } = this.state;
    const payload = { username, password };
    try {
      const res = fetch("http://192.168.1.50:8000/api/login", {
        method: "post",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          "email": this.state.username,
          "password": this.state.password,
        }),
      })
        .then((response) => response.json())
        .then((responseJson) => {
          console.log(responseJson);
          if (!responseJson.error)
            if (responseJson.success.token.length > 0) {
              console.log(responseJson.success.token);
              ExampleState.setState({

                beareer: responseJson.success.token,
              });
              storeauthkey();
            }

        })
        .catch((error) => {
          console.error(error);
        });
    } catch (e) {
      console.log(e);
    }

  };


  render() {
    return (
      <View style={styles.container}>
        <Image style={styles.bgImage} source={{ uri: "https://lorempixel.com/900/1400/nightlife/2/" }} />
        <View style={styles.inputContainer}>
          <TextInput style={styles.inputs}
                     placeholder="Email"
                     value={this.state.username}
                     keyboardType="email-address"
                     underlineColorAndroid="transparent"
                     onChangeText={(username) => this.setState({ username })} />
          <Image style={styles.inputIcon} source={{ uri: "https://img.icons8.com/nolan/40/000000/email.png" }} />
        </View>

        <View style={styles.inputContainer}>
          <TextInput style={styles.inputs}
                     placeholder="Password"
                     value={this.state.password}
                     secureTextEntry={true}
                     underlineColorAndroid="transparent"
                     onChangeText={(password) => this.setState({ password })} />
          <Image style={styles.inputIcon} source={{ uri: "https://img.icons8.com/nolan/40/000000/key.png" }} />
        </View>

        <TouchableOpacity style={styles.btnForgotPassword} onPress={() => this.onClickListener("restore_password")}>
          <Text style={styles.btnText}>Forgot your password?</Text>
        </TouchableOpacity>

        <TouchableOpacity style={[styles.buttonContainer, styles.loginButton]}
                          onPress={() => this.onClickListener("login")}>
          <Text style={styles.loginText}>Login</Text>
        </TouchableOpacity>


        <TouchableOpacity style={styles.buttonContainer} onPress={() => this.onClickListener("register")}>
          <Text style={styles.btnText}>Register</Text>
        </TouchableOpacity>
      </View>
    );
  }
}

const resizeMode = "cover";

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
    backgroundColor: "#DCDCDC",
  },
  inputContainer: {
    borderBottomColor: "#F5FCFF",
    backgroundColor: "#FFFFFF",
    borderRadius: 30,
    borderBottomWidth: 1,
    width: 300,
    height: 45,
    marginBottom: 20,
    flexDirection: "row",
    alignItems: "center",

    shadowColor: "#808080",
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 3.84,

    elevation: 5,
  },
  inputs: {
    height: 45,
    marginLeft: 16,
    borderBottomColor: "#FFFFFF",
    flex: 1,
  },
  inputIcon: {
    width: 30,
    height: 30,
    marginRight: 15,
    justifyContent: "center",
  },
  buttonContainer: {
    height: 45,
    flexDirection: "row",
    justifyContent: "center",
    alignItems: "center",
    marginBottom: 20,
    width: 300,
    borderRadius: 30,
    backgroundColor: "transparent",
  },
  btnForgotPassword: {
    height: 15,
    flexDirection: "row",
    justifyContent: "flex-end",
    alignItems: "flex-end",
    marginBottom: 10,
    width: 300,
    backgroundColor: "transparent",
  },
  loginButton: {
    backgroundColor: "#00b5ec",

    shadowColor: "#808080",
    shadowOffset: {
      width: 0,
      height: 9,
    },
    shadowOpacity: 0.50,
    shadowRadius: 12.35,

    elevation: 19,
  },
  loginText: {
    color: "white",
  },
  bgImage: {
    flex: 1,
    resizeMode,
    position: "absolute",
    width: "100%",
    height: "100%",
    justifyContent: "center",
  },
  btnText: {
    color: "white",
    fontWeight: "bold",
  },
});

