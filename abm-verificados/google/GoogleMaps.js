import {
    useJsApiLoader,
    GoogleMap,
    Marker,
    Autocomplete,
    DirectionsRenderer,
} from '@react-google-maps/api';
import { useRef, useState } from 'react'
import PawLoader from "../components/PawLoader";
import Styles from '../styles/GoogleMaps.module.css';

function GoogleMaps() {
    const { isLoaded } = useJsApiLoader({
        googleMapsApiKey: process.env.API_GOOGLE,
        libraries: ['places']
    });

    const [map, setMap] = useState(/**@type google.maps.Map  */ (null));
    const [direccion, setDireccion] = useState(null);
    const [center, setCenter] = useState({ lat: Number(-34.595951217761645), lng: Number(-58.456828095751796) });

    /** @type React.MutableRefObject<HTMLInputElement> */
    const lugar = useRef();

    if (!isLoaded) return <PawLoader />

    const buscar = async () => {
        const geocoder = new google.maps.Geocoder();
        await geocoder.geocode({ 'address': direccion }, function (resultado, status) {
            if (status == 'OK') {
                setCenter(resultado[0].geometry.location)
            } else {
                console.log('Hubo un error')
            }
        })
    }

    return (
        <div className={"relative"}>
            <div
                className={Styles.contenedor}
            >
                <Autocomplete>
                    <input
                        type={"text"}
                        placeholder={"Lugar"}
                        className={Styles.inputs}
                        ref={lugar}
                        onChange={e => setDireccion(e.target.value)}
                        value={direccion}
                    />
                </Autocomplete>
                <button
                    className={Styles.volver}
                    onClick={ () => map.panTo(center) }
                >
                    Centrar
                </button>
                <button
                    onClick={buscar}
                >Buscar</button>
            </div>
            <GoogleMap
                center={center}
                zoom={16}
                mapContainerStyle={{ width: '100vw', height: '100vh', maxWidth: "100%", maxHeight: "100%" }}
                options={{
                    zoomControl: true,
                    streetViewControl: false,
                    mapTypeControl: false,
                    fullscreenControl: false,
                }}
                onLoad={map => setMap(map)}
            >
                {direccion && (
                    <DirectionsRenderer directions={direccion} />
                )}
                <Marker  position={center}/>
            </GoogleMap>
        </div>
    )
}

export default GoogleMaps;