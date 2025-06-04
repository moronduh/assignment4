// client/App.js
import React from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { NavigationContainer } from '@react-navigation/native';
import SenderScreen from './screens/SenderScreen';
import ReceiverScreen from './screens/ReceiverScreen';

const Tab = createBottomTabNavigator();

export default function App() {
  return (
    <NavigationContainer>
      <Tab.Navigator>
        <Tab.Screen name="Send Message" component={SenderScreen} />
        <Tab.Screen name="Receive Messages" component={ReceiverScreen} />
      </Tab.Navigator>
    </NavigationContainer>
  );
}