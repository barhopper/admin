import React from 'react';
import {View,Text,StyleSheet,TextInput,TouchableOpacity,Image} from 'react-native';
import {widthPercentageToDP as wp, heightPercentageToDP as hp} from 'react-native-responsive-screen';
import images from "../../assets/images";

export default class TickCircle extends React.Component {


    render() {
        let bgColor=this.props.bgColor||"#AC8B34";
        return(
            <View style={styles.container}>
                <View style={styles.containerImg}>
                    <Image style={styles.img} source={this.props.img}/>
                </View>
                    <View style={styles.containerText}>
                        <Text style={styles.text}>{this.props.title}</Text>
                    </View>

            </View>
        );
    }
}

const styles= StyleSheet.create({
    container:{
        flexDirection:'row',
        height:hp(4),
        alignItems:'center',
        // justifyContent:'center',
        marginStart: wp(2),
    },
    containerImg: {
        // alignItems: 'center',
        // width:wp(60),
        // borderRadius:wp(0.5),

    },
    containerText: {
        marginLeft:wp(2)
        // width:wp(60),
        // // backgroundColor: "red",
        // alignItems: 'center',
    },
    text: {

        fontSize: wp(3),
        // textAlign:'center',
        // fontWeight:'700',
        color: '#fff',
        // lineHeight:hp(10),
        // textDecorationLine:'underline',
    },
    img: {
        height:hp(3.5),
        width:wp(3.5),
        resizeMode:'contain',
        tintColor:'#fff'
    }

});


