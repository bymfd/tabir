import { SharedState } from "@huds0n/shared-state";
import EncryptedStorage from "react-native-encrypted-storage";

export let ExampleState = new SharedState({
  beareer: null,

});

export const storeauthkey = async () => {
  let key = ExampleState.state.beareer;
  console.log("asdasdas"+key);
  try {
    await EncryptedStorage.setItem(
      "beareer",
      JSON.stringify({
        beareer: key,
      }),
    );

  } catch (error) {
    console.log(error);
  }
};

export const loadauthkey = async () => {
  const user = await EncryptedStorage.getItem("beareer");
  ExampleState.setState({
    beareer:user

  })
  return user;
};
