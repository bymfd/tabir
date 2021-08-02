import React, { useState } from "react";

import {
  SafeAreaView,
  StyleSheet,
  StatusBar,
} from 'react-native';
import LoginView from './Views/Login/Login';

const App = () => {

  return (

  <LoginView />



  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#f6f6f6"
  },
});

export default App;
