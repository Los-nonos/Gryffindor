import { PrimaryGeneratedColumn, Column, Entity } from 'typeorm';

@Entity()
class Hostel {
  @PrimaryGeneratedColumn()
  public Id!: number;
  @Column()
  public Name: string;
  @Column()
  public Email: string;
  @Column()
  public Address: string;
  @Column()
  public Cuit: number;
  @Column()
  public Password: string;
  @Column()
  public TinyDescription: string;
}

export default Hostel;
