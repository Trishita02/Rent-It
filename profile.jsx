import React, { useState } from 'react';

const ProfilePage = () => {
    const [profile, setProfile] = useState({
        name: 'kalu',
        email: 'kalu.com',
        phone: '123-456-7890',
        address: 'patna bihar',
        clothesDonated: 10,
        clothesRented: 5,
        avatarUrl: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRRHFuPSB6v6qMgw1M9PYT5DtJ4149rZ9bb_uou1qTEnux-LAIYGaB9Yim72voCmAYCyZ4&usqp=CAU', // Placeholder image URL
    });

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setProfile({ ...profile, [name]: value });
    };

    const handleImageUpload = (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onloadend = () => {
                setProfile({ ...profile, avatarUrl: reader.result });
            };
            reader.readAsDataURL(file);
        }
    };

    const styles = {
        container: {
            width: '60%',
            margin: '0 auto',
            padding: '20px',
            backgroundColor: '#f4f4f4',
            borderRadius: '10px',
            boxShadow: '0 0 10px rgba(0, 0, 0, 0.1)',
        },
        header: {
            textAlign: 'center',
            color: '#333',
        },
        avatarContainer: {
            textAlign: 'center',
            marginBottom: '20px',
            position: 'relative',
        },
        avatar: {
            width: '150px',
            height: '150px',
            borderRadius: '50%',
            objectFit: 'cover',
            cursor: 'pointer',
        },
        avatarInput: {
            display: 'none',
        },
        uploadLabel: {
            position: 'absolute',
            top: '50%',
            left: '50%',
            transform: 'translate(-50%, -50%)',
            color: '#fff',
            backgroundColor: 'rgba(0, 0, 0, 0.6)',
            padding: '10px',
            borderRadius: '5px',
            display: 'none',
            cursor: 'pointer',
        },
        avatarContainerHover: {
            display: 'block',
        },
        section: {
            margin: '15px 0',
        },
        label: {
            display: 'block',
            fontWeight: 'bold',
            marginBottom: '5px',
            color: '#555',
        },
        input: {
            width: '100%',
            padding: '10px',
            marginBottom: '10px',
            border: '1px solid #ccc',
            borderRadius: '5px',
            boxSizing: 'border-box',
        },
        nonEditable: {
            display: 'block',
            padding: '10px',
            backgroundColor: '#e9ecef',
            borderRadius: '5px',
            color: '#555',
        },
    };

    return (
        <div style={styles.container}>
            <div
                style={styles.avatarContainer}
                onMouseEnter={(e) => e.currentTarget.querySelector('label').style.display = 'block'}
                onMouseLeave={(e) => e.currentTarget.querySelector('label').style.display = 'none'}
            >
                <img src={profile.avatarUrl} alt="Avatar" style={styles.avatar} />
                <input
                    type="file"
                    accept="image/*"
                    onChange={handleImageUpload}
                    style={styles.avatarInput}
                    id="avatarUpload"
                />
                <label htmlFor="avatarUpload" style={styles.uploadLabel}>Upload</label>
            </div>
            <h1 style={styles.header}>Profile Page</h1>
            <div style={styles.section}>
                <label style={styles.label}>Name:</label>
                <input
                    type="text"
                    name="name"
                    value={profile.name}
                    onChange={handleInputChange}
                    style={styles.input}
                />
            </div>
            <div style={styles.section}>
                <label style={styles.label}>Email:</label>
                <input
                    type="email"
                    name="email"
                    value={profile.email}
                    onChange={handleInputChange}
                    style={styles.input}
                />
            </div>
            <div style={styles.section}>
                <label style={styles.label}>Phone No:</label>
                <input
                    type="tel"
                    name="phone"
                    value={profile.phone}
                    onChange={handleInputChange}
                    style={styles.input}
                />
            </div>
            <div style={styles.section}>
                <label style={styles.label}>Address:</label>
                <input
                    type="text"
                    name="address"
                    value={profile.address}
                    onChange={handleInputChange}
                    style={styles.input}
                />
            </div>
            <div style={styles.section}>
                <label style={styles.label}>No of Clothes Donated:</label>
                <span style={styles.nonEditable}>{profile.clothesDonated}</span>
            </div>
            <div style={styles.section}>
                <label style={styles.label}>No of Clothes Rented:</label>
                <span style={styles.nonEditable}>{profile.clothesRented}</span>
            </div>
        </div>
    );
};

export default ProfilePage;
