import { PrimaryGeneratedColumn, Column, Entity } from 'typeorm';

@Entity()
class User
{
	@PrimaryGeneratedColumn()
	public Id!: number;
	@Column()
	public Name: string;
	@Column()
	public Email: string;
	@Column()
	public Phone: string;
	@Column()
	public Password: string;

}

export default User
