import {useEffect} from "react";
import {useRouter} from "next/router";

export default function Home() {
    const router = useRouter();
    useEffect(() => {
        sessionStorage.getItem('datos') ? router.push('/dashboard') : router.push('/login');
    },[router]);
}