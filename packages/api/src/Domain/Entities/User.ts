import { PrimaryGeneratedColumn, Column, Entity, ManyToMany } from 'typeorm';
import * as bcrypt from 'bcrypt';
import UserRole from './UserRole';

@Entity()
class User {
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

  @ManyToMany(_type => UserRole)
  public Roles: UserRole[];

  public hashPassword(unHashPassword: string) {
    this.Password = bcrypt.hashSync(unHashPassword, 8);
  }

  public checkPasswordUnhashedIsValid(unHashPassword: string): boolean {
    return bcrypt.compareSync(unHashPassword, this.Password);
  }
}

export default User;
